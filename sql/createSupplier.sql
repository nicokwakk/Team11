#CREATE DEFINER=`17ac3u11`@`silva.computing.dundee.ac.uk`
DELIMITER //
DROP PROCEDURE IF EXISTS 17ac3d11.`CreateSupplier` //

CREATE PROCEDURE 17ac3d11.`CreateSupplier` (IN FLine varchar(255),
IN SLine varchar(255),
IN Pscode varchar(8),
IN SCountry varchar(255),
IN SCity varchar(255),
IN SupName varchar(255),
IN SAccountName varchar(255),
IN SAccountNum int(8),
IN SSortCode int(6),
OUT sID INT(5))
BEGIN
	DECLARE aID INT(5);
	INSERT INTO 17ac3d11.addresses (FirstLineAddress,SecondLineAddress,PostCode,Country,City)
	values (FLine,SLine,Pscode,SCountry,SCity);
    
    SET aID = LAST_INSERT_ID();
    
    INSERT INTO 17ac3d11.bankinformation (AccountName,AccountNumber,SortCode)
    VALUES
    (SAccountName,SAccountNum,SSortCode);
    
    INSERT INTO 17ac3d11.suppliers (SupplierName,SupplierAddressID,SupplierBankInformationID)
    values (SupName,aID,LAST_INSERT_ID());
    
	SET sID = LAST_INSERT_ID();
END //
DELIMITER ;
