#CREATE DEFINER=`17ac3u11`@`silva.computing.dundee.ac.uk`
DELIMITER //
DROP PROCEDURE IF EXISTS 17ac3d11.`CreateCustomer` //

CREATE PROCEDURE 17ac3d11.`CreateCustomer` (
#Customer Params
IN FLine varchar(255),
IN SLine varchar(255),
IN Cscode varchar(8),
IN CCountry varchar(255),
IN CCity varchar(255),
IN CFName varchar(255),
IN CMName varchar(255),
IN CLName varchar(255),
IN CPNum int(11),
IN CNewsLP int(1),
IN CEmail varchar(255),
IN CPass varchar(255),
IN CSalt varchar(255),
OUT cID INT(5))
BEGIN
	DECLARE addID INT(5);
    DECLARE nameID INT(5);
    DECLARE passID INT(10);
    DECLARE emergID INT(5);
    
	INSERT INTO 17ac3d11.Names (FirstName,MiddleName,LastName)
    VALUES
    (CFName,CMName,CLName);
    
    SET nameID = LAST_INSERT_ID();
    
    INSERT INTO 17ac3d11.addresses (FirstLineAddress,SecondLineAddress,PostCode,Country,City)
	values (CFLine,CSLine,CPscode,CCountry,CCity);
    
    SET addID = LAST_INSERT_ID();
    

    INSERT INTO 17ac3d11.passwords (HashedPass,SaltKey)
    VALUES
    (CPass,CSalt);
    
    SET passID = LAST_INSERT_ID();
    
    INSERT INTO 17ac3d11.customers (custNameID,custAddressID,Email,ContactNum,NewsletterPref,CustPasswordID)
    values 
    (nameID,addID,CEmail,CPNum,CNewsLP,passID);
    
	SET cID = LAST_INSERT_ID();
END //
DELIMITER ;
