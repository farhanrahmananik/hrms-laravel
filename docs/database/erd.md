\# HRMS Laravel - Database ERD



\## Purpose



This document describes the Entity Relationship Diagram (ERD) for the HRMS Laravel project.



\## ERD Scope



The ERD covers the core HRMS business modules:



\- Authentication \& Authorization

\- Organization Structure

\- Attendance Management

\- Leave Management

\- Payroll Management



Laravel internal infrastructure tables such as `migrations`, `cache`, and `jobs` are not included in the main business ERD.



\## Architecture Notes



\- `users` table handles authentication identity.

\- `employees` table handles HR/business identity.

\- Role and permission management uses pivot tables.

\- Attendance, leave, and payroll data are separated into transactional tables.

\- Payroll uses an itemized payslip structure for production-style salary breakdown.



\## Text-based ERD



\### Authentication \& Authorization



users many-to-many roles through role\_user  

roles many-to-many permissions through permission\_role



\### Organization Structure



users 1 to 0/1 employees  

departments 1 to many designations  

departments 1 to many employees  

designations 1 to many employees



\### Attendance Management



employees 1 to many attendances



\### Leave Management



employees 1 to many leave\_requests  

leave\_types 1 to many leave\_requests  

employees 1 to many leave\_balances  

leave\_types 1 to many leave\_balances



\### Payroll Management



employees 1 to many employee\_salary\_structures  

salary\_components 1 to many employee\_salary\_structures  

payroll\_runs 1 to many payslips  

employees 1 to many payslips  

payslips 1 to many payslip\_items  

salary\_components 1 to many payslip\_items



\## Mermaid ERD



```mermaid

erDiagram



&#x20;   USERS {

&#x20;       bigint id PK

&#x20;       string name

&#x20;       string email

&#x20;       string password

&#x20;       string status

&#x20;       timestamp email\_verified\_at

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;   }



&#x20;   ROLES {

&#x20;       bigint id PK

&#x20;       string name

&#x20;       string slug

&#x20;       string description

&#x20;       boolean is\_active

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   PERMISSIONS {

&#x20;       bigint id PK

&#x20;       string name

&#x20;       string slug

&#x20;       string description

&#x20;       boolean is\_active

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   ROLE\_USER {

&#x20;       bigint id PK

&#x20;       bigint user\_id FK

&#x20;       bigint role\_id FK

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;   }



&#x20;   PERMISSION\_ROLE {

&#x20;       bigint id PK

&#x20;       bigint role\_id FK

&#x20;       bigint permission\_id FK

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;   }



&#x20;   DEPARTMENTS {

&#x20;       bigint id PK

&#x20;       string name

&#x20;       string code

&#x20;       string description

&#x20;       boolean is\_active

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   DESIGNATIONS {

&#x20;       bigint id PK

&#x20;       bigint department\_id FK

&#x20;       string title

&#x20;       string code

&#x20;       string description

&#x20;       boolean is\_active

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   EMPLOYEES {

&#x20;       bigint id PK

&#x20;       bigint user\_id FK

&#x20;       bigint department\_id FK

&#x20;       bigint designation\_id FK

&#x20;       string employee\_code

&#x20;       string phone

&#x20;       string gender

&#x20;       date date\_of\_birth

&#x20;       date joining\_date

&#x20;       string employment\_status

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   ATTENDANCES {

&#x20;       bigint id PK

&#x20;       bigint employee\_id FK

&#x20;       date attendance\_date

&#x20;       time check\_in

&#x20;       time check\_out

&#x20;       string status

&#x20;       text remarks

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   LEAVE\_TYPES {

&#x20;       bigint id PK

&#x20;       string name

&#x20;       string code

&#x20;       int default\_days

&#x20;       boolean is\_active

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   LEAVE\_REQUESTS {

&#x20;       bigint id PK

&#x20;       bigint employee\_id FK

&#x20;       bigint leave\_type\_id FK

&#x20;       date start\_date

&#x20;       date end\_date

&#x20;       decimal total\_days

&#x20;       string status

&#x20;       text reason

&#x20;       bigint approved\_by

&#x20;       timestamp approved\_at

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   LEAVE\_BALANCES {

&#x20;       bigint id PK

&#x20;       bigint employee\_id FK

&#x20;       bigint leave\_type\_id FK

&#x20;       int year

&#x20;       decimal total\_days

&#x20;       decimal used\_days

&#x20;       decimal remaining\_days

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   SALARY\_COMPONENTS {

&#x20;       bigint id PK

&#x20;       string name

&#x20;       string code

&#x20;       string type

&#x20;       boolean is\_taxable

&#x20;       boolean is\_active

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   EMPLOYEE\_SALARY\_STRUCTURES {

&#x20;       bigint id PK

&#x20;       bigint employee\_id FK

&#x20;       bigint salary\_component\_id FK

&#x20;       decimal amount

&#x20;       date effective\_from

&#x20;       date effective\_to

&#x20;       boolean is\_active

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   PAYROLL\_RUNS {

&#x20;       bigint id PK

&#x20;       int payroll\_month

&#x20;       int payroll\_year

&#x20;       date payment\_date

&#x20;       string status

&#x20;       timestamp processed\_at

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   PAYSLIPS {

&#x20;       bigint id PK

&#x20;       bigint payroll\_run\_id FK

&#x20;       bigint employee\_id FK

&#x20;       decimal gross\_salary

&#x20;       decimal total\_deductions

&#x20;       decimal net\_salary

&#x20;       string status

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;       timestamp deleted\_at

&#x20;   }



&#x20;   PAYSLIP\_ITEMS {

&#x20;       bigint id PK

&#x20;       bigint payslip\_id FK

&#x20;       bigint salary\_component\_id FK

&#x20;       decimal amount

&#x20;       string type

&#x20;       timestamp created\_at

&#x20;       timestamp updated\_at

&#x20;   }



&#x20;   USERS ||--o{ ROLE\_USER : "assigned roles"

&#x20;   ROLES ||--o{ ROLE\_USER : "assigned users"



&#x20;   ROLES ||--o{ PERMISSION\_ROLE : "has permissions"

&#x20;   PERMISSIONS ||--o{ PERMISSION\_ROLE : "belongs to roles"



&#x20;   USERS ||--o| EMPLOYEES : "has employee profile"



&#x20;   DEPARTMENTS ||--o{ DESIGNATIONS : "has designations"

&#x20;   DEPARTMENTS ||--o{ EMPLOYEES : "has employees"

&#x20;   DESIGNATIONS ||--o{ EMPLOYEES : "assigned to employees"



&#x20;   EMPLOYEES ||--o{ ATTENDANCES : "has attendance records"



&#x20;   EMPLOYEES ||--o{ LEAVE\_REQUESTS : "submits leave requests"

&#x20;   LEAVE\_TYPES ||--o{ LEAVE\_REQUESTS : "used in leave requests"



&#x20;   EMPLOYEES ||--o{ LEAVE\_BALANCES : "has leave balances"

&#x20;   LEAVE\_TYPES ||--o{ LEAVE\_BALANCES : "has leave balances"



&#x20;   EMPLOYEES ||--o{ EMPLOYEE\_SALARY\_STRUCTURES : "has salary structures"

&#x20;   SALARY\_COMPONENTS ||--o{ EMPLOYEE\_SALARY\_STRUCTURES : "used in salary structures"



&#x20;   PAYROLL\_RUNS ||--o{ PAYSLIPS : "generates payslips"

&#x20;   EMPLOYEES ||--o{ PAYSLIPS : "receives payslips"



&#x20;   PAYSLIPS ||--o{ PAYSLIP\_ITEMS : "has payslip items"

&#x20;   SALARY\_COMPONENTS ||--o{ PAYSLIP\_ITEMS : "used in payslip items"

