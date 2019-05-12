# CANCLUB
**CENG382 - Web Programming Course Project**

CANCLUB is a student club activity proposal voting and tracking system.

It is an easy-to-use, web-based application through which club members can propose, vote, and track the student club activities such as seminars, technical visits, meetings, projects, etc.

## TODO

- [x] Design Initial Database
  - [x] "users" table
    - [x] edit to add department_id column
    - [x] edit to add is_prez column
  - [x] "activities" table
    - [x] add "vote_count" column to find trends easily
  - [x] "comments" table
  - [x] "votes" table
  - [x] "departments" table (if added, edit "users" to add department!)
  - [x] Design the relations
    - [x] Make sure which is Foreign key (user_ id in activities) / Referenced key (user_ id in users)
- [x] Registration Functionality
  - [x] First Name
  - [x] Last Name
  - [x] Birth Date
  - [x] Email
  - [x] Department
    - [x] List departments using PHP (foreach) / MySQL
  - [x] Username
  - [x] Password
- [x] Add Photo to Register page
- [x] Login Page
- [x] Main Activity "Wall" page
- [x] Propose Activity
- [ ] Individual Activity page for each activity with voting functionality
  - [x] Individual page
  - [x] Voting
  - [x] Comment Function for Voting Page
    - [x] Add comment
    - [x] List comments
- [X] Club member list page for Club Presidents with option to delete members.
  - [x] The list
  - [X] Delete function
- [x] Trending Activity Proposals Page
- [x] Profile Page for each user so that they can update their own info.
  - [x] Profile page
  - [x] Update info
- [ ] Write Project Report