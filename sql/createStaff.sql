#CREATE DEFINER=`17ac3u11`@`silva.computing.dundee.ac.uk`
DELIMITER //
DROP PROCEDURE IF EXISTS 17ac3d11.`CreateStaff` //

CREATE PROCEDURE 17ac3d11.`CreateStaff` (
#Staff Params
IN Bid int(5),
IN FLine varchar(255),
IN SLine varchar(255),
IN Pscode varchar(8),
IN SCountry varchar(255),
IN SCity varchar(255),
IN SFName varchar(255),
IN SMName varchar(255),
IN SLName varchar(255),
IN SPNum int(11),
IN SGender varchar(1),
IN SPermLevel int(1),
IN SJobTitle varchar(255),
IN SSalary int(6),
IN SEmail varchar(255),
IN SAccountName varchar(255),
IN SAccountNum int(8),
IN SSortCode int(6),
IN SPass varchar(255),
IN SSalt varchar(255),

#EMERGENCY CONTACT PARAMS
IN SEFName varchar(255),
IN SEMName varchar(255),
IN SELName varchar(255),
IN SEPNum int(11),
IN EFLine varchar(255),
IN ESLine varchar(255),
IN EPscode varchar(8),
IN ESCountry varchar(255),
IN ESCity varchar(255),

OUT sID INT(5))
BEGIN
	DECLARE addID INT(5);
    DECLARE bankID INT(5);
    DECLARE nameID INT(5);
    DECLARE enameID INT(5);
    DECLARE eaddID INT(5);
    DECLARE passID INT(5);
    DECLARE emergID INT(5);
    
    #EMERGENCY CONTACT INSERTS
	INSERT INTO 17ac3d11.Names (FirstName,MiddleName,LastName)
    VALUES
    (SEFName,SEMName,SELName);
    
    SET enameID = LAST_INSERT_ID();
    
    INSERT INTO 17ac3d11.addresses (FirstLineAddress,SecondLineAddress,PostCode,Country,City)
	values (EFLine,ESLine,EPscode,ESCountry,ESCity);
    
    SET eaddID = LAST_INSERT_ID();
    
    INSERT INTO 17ac3d11.emergencycontact (EMNameID,EMNum,EMAddID)
    VALUES
    (enameID,SEPNum,eaddID);
    
    SET emergID = LAST_INSERT_ID();
    
    #STAFF INSERT
	INSERT INTO 17ac3d11.addresses (FirstLineAddress,SecondLineAddress,PostCode,Country,City)
	values (FLine,SLine,Pscode,SCountry,SCity);
    
    SET addID = LAST_INSERT_ID();
    
    INSERT INTO 17ac3d11.bankinformation (AccountName,AccountNumber,SortCode)
    VALUES
    (SAccountName,SAccountNum,SSortCode);
    
    SET bankID = LAST_INSERT_ID();
	
	INSERT INTO 17ac3d11.Names (FirstName,MiddleName,LastName)
    VALUES
    (SFName,SMName,SLName);
    
    SET nameID = LAST_INSERT_ID();
    

    INSERT INTO 17ac3d11.passwords (HashedPass,SaltKey)
    VALUES
    (SPass,SSalt);
    
    SET passID = LAST_INSERT_ID();
    
    INSERT INTO 17ac3d11.Staff (BranchID,NameID,JobTitle,ContactNum,EmergencyContactID,StaffAddressID,Email,StaffPasswordID,PermissionLevel,Salary,BankInformationID,Gender)
    values 
    (Bid,nameID,SJobTitle,SPNum,emergID,addID,SEmail,passID,SPermLevel,SSalary,bankID,SGender);
    
	SET sID = LAST_INSERT_ID();
END //
DELIMITER ;
