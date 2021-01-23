# "University of Ansh" project 

This was a project for my Advanced Web Apps Class during my senior year of high school. It is a working university admissions system that has an admin account for reviewing applications and enables applicants to create accounts to apply to the school.

For testing purposes: admin account login is "admin" and password is "adminacc". From admin account, you can review completed applications, view accepted applicants, review waitlisted applicants, and view enrolled applicants. 

For the applicants, they must create an account in the myPortal. Once they create an account, they can view their submitted applications, review their info, and submit new applications.  I have created multiple dummy accounts with varying stages in the 'accounts' table in the database (for each one, the password is the first name + "iscool".  After every application is successfully processed, an app id (which is a key that I use to get data in almost all the tables) is created for the application. 

There is a recommendations page for recommenders to submit their letters, and they must ask the student for their app id so the recommendation can be matched with the applicant. There is also a transcript upload page for the student's counselor to upload a PDF file (with basic verification) of the student's transcript using their app id. The file will be saved in a folder with their app id and the admin may look at the transcript separately before making an admissions decision.  In order for the admin to be able to review the application, a recommendation and transcript must be submitted for the application. Then, the admin can view all the info and make an admissions decision; if accepted, the data will updated in the necessary tables.
