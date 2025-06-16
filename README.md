# Simple Chore Tracker

## Goals
Chore Tracker is an in-development web application aimed at helping families manage and track chores for kids and adults. The following are project goals: allow adults to create and approve tasks, and enable kids to complete chores to earn screen time or allowance. Kids will be able to mark tasks as complete and submit their used screen time, while adults oversee and approve these actions.

## Feature Goals
- **User Roles**: 
  - **Kid**: Can select tasks as complete, submit used screen time, and view earned time/money.
  - **Adult**: Can create tasks, approve submitted time, and view logs of completed tasks.
  - **Admin**: Can manage user roles

- **Task Management**: 
  - Adults can create, update,approve, and manage tasks.
  - Kids can view and complete tasks.

- **Timer Functionality**: 
  - Kids can start and stop a timer to track their screen time usage.
  - Kids can submit their used time for approval.

- **Logging**: 
  - Both roles can view logs of time submissions and tasks completed.

## ENV File
```
DB_HOST=db
DB_ROOT_PASS=root
DB_NAME=chore_tracker
DB_USER=admin
DB_PASS=admin

```
## Run Project
### Build the Docker Container:
```bash
docker-compose up -d --build
```

### Seed database
enter web container and run 
```bash
php config/migrate
```
### Access the Application:
   Open your web browser and navigate to `http://localhost:8000` to access the Chore Tracker application.

## Usage
- **Login**: Users can log in using their credentials.
- **Dashboard**: Depending on the user role, users will see different dashboards with relevant options.
- **Task Management**: Adults can create and approve tasks, while kids can complete tasks and submit their time.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.