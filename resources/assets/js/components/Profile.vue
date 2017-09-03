<template>
    <div class="container profile-container">
        <div class="row">
            <div class="col-md-4 project-list">
                <ul class="list-group">
                    <li :class="{'active-project': currentProjectIndex == projectIndex}"
                        class="list-group-item"
                        @click="currentProjectIndex = projectIndex"
                        v-for="(project, projectIndex) in projects">
                        <span class="badge badge-danger">
                            {{getCountTasks('important', projectIndex)}}
                        </span>
                        <span class="badge badge-info">
                            {{getCountTasks('default', projectIndex)}}
                        </span>
                        <span class="badge badge-default">
                            {{getCountTasks('completed', projectIndex)}}
                        </span>
                        <span class="project-name">{{ project.name }}</span>
                    </li>
                </ul>
            </div>
            <project
                    v-if="currentProject.id"
                    :currentProjectIndex="currentProjectIndex"
                    @project-delete="handleDeleteProject"
                    :project="currentProject"
                    >
            </project>
        </div>
    </div>
</template>

<script>
    import bus from '../bus';
    export default {
        data: function () {
            return {
                currentProjectIndex: 0
            }
        },
        created: function () {
            let self = this;
            bus.$on('create-project', function () {
                self.currentProjectIndex = 0;
            });
        },
        methods: {
            handleDeleteProject: function (projectIndex) {
                this.projects.splice(projectIndex, 1);
                this.currentProjectIndex = 0
            },
            getCountTasks: function (type, projectIndex) {
                let count = 0;
                let tasks = this.projects[projectIndex].tasks;
                for (let key in tasks) {
                    switch (type) {
                        case 'default':
                            if (!tasks[key].is_important && !tasks[key].is_completed) {
                                count++;
                            }

                            break;

                        case 'important':
                            if (tasks[key].is_important && !tasks[key].is_completed) {
                                count++;
                            }

                            break;

                        case 'completed':
                            if (tasks[key].is_completed) {
                                count++;
                            }
                            break;

                    }

                }
                return count;
            },

        },
        props: ['projects'],
        computed: {
            currentProject: {
                get: function () {
                    if (this.projects[this.currentProjectIndex] !== undefined) {
                        return this.projects[this.currentProjectIndex];
                    }
                    return [];
                },
                set: function (projectIndex) {
                    this.currentProjectIndex = projectIndex;
                }
            },
        }
    }
</script>
