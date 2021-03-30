## Import Player Information

The import functionality would be best if it emulated the functionality in the surge application.

A members model that would contain the following fields which could be imported (minimum)

* First Name
* Last Name
* DOB
* email
* parent_email
* parent2_email
* MemberID (ID, i.e. Hockey Canada ID) Optional String
* Type  ("Player, Coach, Staff") Optional String
* Group  ("Team, School, etc") Optional String

#### Rules

* Imports would detect duplicates using MemberID or a combination of First,Last, DOB, email

#### User Experience

1.  User uploads the CSV
2.  User matches the CSV columns to the field columns and clicks import
3.  Options for how to deal with imports
    * Files is uploaded then process asynchronously using toast to show status.   i.e. Uploaded, Process, Complete OK, Failed to process
    * Files is validated in realtime 

#### Iterative Development 

1. Use factories first to populate members, allows other funcationality to be tested and implemented while the import is used
2. Manual Add/Update should be priority over import


