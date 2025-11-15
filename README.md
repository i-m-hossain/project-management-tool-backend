## Build a small Project & Task Management system where:

- Users can create Projects
- Each Project has multiple Tasks
- Tasks can be marked as Pending or Done
- The React frontend consumes the Laravel API




## Core Entity:
- User
- Project
- Task

##  Endpoints:
- CRUD: /users
- /projects
- /tasks

## relationships:
- User 1---N Project
  User 1---N Task
- Project 1---N Task

Models
## User 
- id
- email
- password
- role_id : Role
- timestamp
  
## Role:
- id 
- name
- timestamp

## Project:
- id
- name
- link
- states

## ProjectStates:
- id
- project_id
- state_id

# States: 
- id
- name 


## Task:
- id
- name
- state : Backlog, WIP, UAT, Prod, Done
- project_id: Project
-  