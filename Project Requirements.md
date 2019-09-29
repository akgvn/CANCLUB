# Project Requirements

~~First of all, club members should register into the system. During registration process, the fields listed below should be filled by the club member:~~
- ~~First Name~~
- ~~Last Name~~
- ~~Birth Date~~
- ~~Email~~
- ~~Department~~
- ~~Username~~
- ~~Password~~
- ~~Photo~~

After the registration process, the club member can do the following operations by using the CANCLUB:
* ~~A login system: Only registered club members can have an access to the CANCLUB.~~
* ~~Propose new activity to be voted by club members: A registered club member can propose a new activity by specifying the type of activity (e.g. seminar, technical visit, social responsibility project, club project, etc.), and the description of the activity.~~
* Confirm/Deny activity proposals: ~~The users can approve or disapprove the activity proposals of the other club members. All registered club members can like or dislike the activity proposal. The activity proposal will be open for voting for only fifteen days.~~ **In addition, the users can write comments on each activity proposal.**
* List/Delete Club Members: Only the club president can list or delete the club member(s).
* ~~See Trend Activity proposals: The users can see the most popular 5 activity proposals. The popularity of an activity offer can be determined as (number of approves - number of disapproves).~~
* ~~Update Personal Information: The users can update his/her personal information.~~

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
- [x] Individual Activity page for each activity with voting functionality
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
