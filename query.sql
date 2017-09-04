
--1.
--did not understand the tasks


--2. get the count of all tasks in each project, order by tasks count descending
Select projects.name, COUNT(projects.name) as 'count_tasks'
FROM projects
INNER JOIN tasks on tasks.project_id = projects.id
GROUP BY projects.name
ORDER BY count_tasks DESC;
--

--3. get the count of all tasks in each project, order by projects names
Select projects.name, COUNT(projects.name) as 'count_tasks'
FROM projects
INNER JOIN tasks on tasks.project_id = projects.id
GROUP BY projects.name
ORDER BY projects.name;
--

--4. get the tasks for all projects having the name beginning with “N” letter
Select tasks.name
FROM tasks
WHERE tasks.name LIKE 'N%';
--

--5. get the list of all projects containing the ‘a’ letter in the middle of the name, and
--   show the tasks count near each project. Mention that there can exist projects without
--   tasks and tasks with project_id=NULL

SELECT
	name, COUNT(name) as 'count_tasks'
FROM
	(
		SELECT
			projects.id, projects.`name`
		FROM
			projects
		LEFT JOIN tasks ON tasks.project_id = projects.id
		WHERE
			projects.`name` LIKE '%a%'
		UNION
			SELECT
				projects.id, projects.`name`
			FROM
				projects
			RIGHT JOIN tasks ON tasks.project_id = projects.id
			WHERE
				projects.`name` LIKE '%a%'
	) AS tmp
GROUP BY name

--6. get the list of tasks with duplicate names. Order alphabetically
SELECT tasks.name , COUNT(tasks.name) as 'count_duplicate'
FROM tasks
GROUP BY tasks.name
HAVING count_duplicate > 1
ORDER BY tasks.name
--

--7. get the list of tasks having several exact matches of both name and status, from
--   the project ‘Garage’. Order by matches count
SELECT tasks.name, COUNT(tasks.name) as 'count_duplicate_tasks'
FROM projects
JOIN tasks ON tasks.project_id = projects.id
WHERE projects.`name` = 'Garage'
GROUP BY tasks.name, tasks.is_completed
HAVING count_duplicate_tasks > 1
ORDER BY count_duplicate_tasks DESC
--8. get the list of project names having more than 10 tasks in status ‘completed’. Order
--   by project_id
SELECT projects.id, COUNT(projects.id) as 'count_tasks'
FROM projects
JOIN tasks ON tasks.project_id = projects.id
WHERE tasks.is_completed = 1
GROUP BY projects.id
HAVING count_tasks > 10
ORDER BY projects.id
------------------------
