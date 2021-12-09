use canvas;
load data local infile 'Instructor.csv' into table Instructor
fields terminated by ',';

load data local infile 'Class.csv' into table Class
fields terminated by ',';

load data local infile 'Student.csv' into table Student
fields terminated by ',';


load data local infile 'TA.csv' into table TA
fields terminated by ',';

load data local infile 'Post.csv' into table Post
fields terminated by ',';

load data local infile 'Assignment.csv' into table Assignment
fields terminated by ',';

load data local infile 'Reply.csv' into table Reply
fields terminated by ',';

load data local infile 'FinalScore.csv' into table Score
fields terminated by ',';