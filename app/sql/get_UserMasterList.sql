SELECT 
    ROWNUM AS "No.", 
    ID, 
    USERNAME AS "Username", 
    PASSWORD AS "Password", 
    DB_NAME AS "DB Name", 
    APPLICATION AS "Application", 
    DATE_CREATED AS "Creation date",
    CREATED_BY AS "Created By", 
    REQUESTOR AS "Requestor", 
    REMARKS AS "Remarks", 
    STATUS AS "Status"
FROM 
    USER_MASTER 
WHERE 
    USERNAME 
IN 
    (SELECT USERNAME FROM USER_MASTER) 
AND 
    USERNAME LIKE CONCAT(:search,'%')