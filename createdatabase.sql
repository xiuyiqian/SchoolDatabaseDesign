drop database if exists canvas;
create database canvas;
use canvas;

create table Instructor(
	TeacherID varchar(255) primary key,
    TLoginID varchar(255),
    TFname varchar(255),
    TLname varchar(255)
);

create table Class(
	ClassID varchar(255) primary key,
	InstructorID varchar(255),
    ClassNum varchar(255),
	ClassName varchar(255),
    Semester varchar(255),
    cyear int,
    foreign key (InstructorID) References Instructor(TeacherID)
);

create table Assignment(
	AssignmentID varchar(255) primary key,
    CID varchar(255),
    AssignmentName varchar(255),
    AssignmentDueDate varchar(255),
	AssignmentText varchar(255),
    TotalPoints varchar(255),
    foreign key (CID) References Class(ClassID)
);

create table Student(
	IdentityID varchar(255) primary key,
    LoginID varchar(255) ,
    Fname varchar(255),
    Lname varchar(255)
);

create table TA(
	TAIdentityID varchar(255),
	ClassID varchar(255),
    foreign key(TAIdentityID) References Student(IdentityID)
);

create table Score(
	StudentID varchar(255),
    ClassID varchar(255),
    Assignment1Grade int null,
	Assignment2Grade int null,
    Assignment3Grade int null,
    Assignment4Grade int null,
    Assignment5Grade int null,
    Assignment6Grade int null,
    Assignment7Grade int null,
    Assignment8Grade int null,
    Assignment9Grade int null,
    Assignment10Grade int null,
	LetterScore varchar(10),
    foreign key(StudentID) References Student(IdentityID),
    foreign key (ClassID) References Class(ClassID)
);

create table Post(
	QuestionID varchar(100) primary key,
	ClassID varchar(100),
	PostTitle varchar(100),
    PostDate varchar(100),
    PostText text,
    PostTag1 varchar (50),
    PostTag2 varchar(50),
    PosterID varchar(100)
    );

create table Reply(
	ReplyID varchar(100) primary key,
    QuestionID varchar(100),
    ResponseDate varchar(100),
    ResponseText text,
	ResponserID varchar(100)
);


