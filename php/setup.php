<?php 
	/*
	PHP code used to create table and admin user directly in phpMyadmin under root
	
	CREATE USER 'unltdmgmt'@'localhost' IDENTIFIED BY '8359248';
	CREATE DATABASE IF NOT EXISTS `unltdmgmt`;
	GRANT ALL PRIVILEGES ON `unltdmgmt`.* TO 'unltdmgmt'@'localhost';
	GRANT ALL PRIVILEGES ON `unltdmgmt\_%`.* TO 'unltdmgmt'@'localhost';
	*/

	// Connect to the database
	$dbhost = "localhost";
	$dbuser = "unltdmgmt";
	$dbpass = "8359248";
	$dbname = "unltdmgmt";

	$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if ($db->connect_error) {
		die("Connection Failed: " . $db->connect_error);
	}

	// Create a table for users
	$sql = "CREATE TABLE IF NOT EXISTS users (
		userId INT UNSIGNED NOT NULL AUTO_INCREMENT,
		userName VARCHAR(50) NULL UNIQUE,
		email VARCHAR(255) NOT NULL UNIQUE,
		password VARCHAR(128) NOT NULL,
		firstName VARCHAR(50) NOT NULL,
		lastName VARCHAR(50) NOT NULL,
		company VARCHAR(128) NOT NULL,
		status VARCHAR(10) NOT NULL,
		PRIMARY KEY (userid)
	) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table users has been created successfully<br>";
	}
	else {
		echo "Error creating table users: " . $db->error . "<br>";
	}

	// Create an initial administrator user
	/* Default credentials: 
		username: administrator
		password: admin
	*/
	$adminpass = password_hash("admin", PASSWORD_DEFAULT);
	$sql = "INSERT INTO users (username, email, password, firstName, lastName, company, status) VALUES ('administrator', ' ', '{$adminpass}', ' ', ' ', 'Unlimited Companies', 'active')";
	if ($db->query($sql) === TRUE) {
		echo "The administrator user has been created successfully<br>";
	}
	else {
		echo "Error creating the administrator user: " . $db->error . "<br>";
	}


	//Create table for roles
	$sql = "CREATE TABLE IF NOT EXISTS roles (
		roleId INT UNSIGNED NOT NULL AUTO_INCREMENT,
		roleName VARCHAR(50) NOT NULL,
		PRIMARY KEY (roleId)
	) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table roles has been created successfully<br>";
	}
	else {
		echo "Error creating the table roles: " . $db->error . "<br>";
	}


	//Create table to assign users to roles
	$sql = "CREATE TABLE IF NOT EXISTS users_roles (
		users_roles_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		userId INT UNSIGNED NOT NULL,
		roleId INT UNSIGNED NOT NULL,
		PRIMARY KEY (users_roles_id),
		FOREIGN KEY (userId) REFERENCES users(userId),
		FOREIGN KEY (roleId) REFERENCES roles(roleId)
	) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table users_roles has been created successfully<br>";
	}
	else {
		echo "Error creating the table users_roles: " . $db->error . "<br>";
	}


	//Create table customers
	$sql = "CREATE TABLE IF NOT EXISTS customers (
		customerId INT UNSIGNED NOT NULL AUTO_INCREMENT,
		customerName VARCHAR(50) NOT NULL,
		customerEmail VARCHAR(255) NULL,
		customerPhone VARCHAR(20) NULL,
		customerPhoneExt VARCHAR(10) NULL,
		customerFax VARCHAR(20) NULL,
		customerWebsite VARCHAR(255) NULL,
		customerAddressStreet VARCHAR(128) NULL,
		customerAddressCity VARCHAR(50) NULL,
		customerAddressState CHAR(2) NULL,
		customerAddressZip VARCHAR(10) NULL,
		userId INT UNSIGNED NULL,
		PRIMARY KEY (customerId),
		FOREIGN KEY (userId) REFERENCES users(userId)
	) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table customers has been created successfully<br>";
	}
	else {
		echo "Error creating the table customers: " . $db->error . "<br>";
	}


	//Create a table for customer representatives
	$sql = "CREATE TABLE IF NOT EXISTS customerReps (
		customerRepId INT UNSIGNED NOT NULL AUTO_INCREMENT,
		customerRepFirstName VARCHAR(50) NOT NULL,
		customerRepLastName VARCHAR(50) NULL,
		customerRepPosition VARCHAR(50) NULL,
		customerRepEmail VARCHAR(255) NOT NULL,
		customerRepPhone VARCHAR(20) NULL,
		customerRepPhoneExt VARCHAR(10) NULL,
		customerRepMobile VARCHAR(20) NULL,
		customerRepMain TINYINT(1) NOT NULL DEFAULT 0,
		customerId INT UNSIGNED NOT NULL,
		PRIMARY KEY (customerRepId),
		FOREIGN KEY (customerId) REFERENCES customers(customerId)
	) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table customers has been created successfully<br>";
	}
	else {
		echo "Error creating the table customers: " . $db->error . "<br>";
	}


	//Create a table for vendors
	$sql = "CREATE TABLE IF NOT EXISTS `unltdmgmt`.`vendors` (
		vendorId INT UNSIGNED NOT NULL AUTO_INCREMENT,
		vendorName VARCHAR(50) NOT NULL,
		vendorProductLine VARCHAR(50) NOT NULL,
		vendorEmail VARCHAR(255) NULL,
		vendorPhone VARCHAR(20) NULL,
		vendorPhoneExt VARCHAR(10) NULL,
		vendorFax VARCHAR(20) NULL,
		vendorStreet VARCHAR(128) NULL,
		vendorCity VARCHAR(50) NULL,
		vendorState CHAR(2) NULL,
		vendorZipCode VARCHAR(10) NULL,
		vendorWebsite VARCHAR(255) NULL,
		userId INT UNSIGNED NULL,
		PRIMARY KEY (vendorId),
		FOREIGN KEY (userId) REFERENCES users(userId)
    ) ENGINE = InnoDB";
?>





-- -----------------------------------------------------
-- Table `unltdmgmt`.`vendorReps`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`vendorReps` (
  `vendorRepId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendorRepFirstName` VARCHAR(45) NOT NULL,
  `vendorRepLastName` VARCHAR(45) NULL,
  `vendorRepEmail` VARCHAR(255) NOT NULL,
  `vendorRepPhone` VARCHAR(20) NULL,
  `vendorRepPhoneExt` VARCHAR(10) NULL,
  `vendorRepMobile` VARCHAR(20) NULL,
  `vendorId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`vendorRepId`),
  INDEX `vendorId_idx` (`vendorId` ASC),
  CONSTRAINT `vendorId`
    FOREIGN KEY (`vendorId`)
    REFERENCES `unltdmgmt`.`vendors` (`vendorId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`employees`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`employees` (
  `employeeId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `employeeMobilePhone` VARCHAR(20) NULL,
  `employeePosition` VARCHAR(20) NOT NULL,
  `employeeStartDate` DATE NOT NULL,
  `employeeTerminationDate` DATE NULL,
  `employeeSkills` TEXT NULL,
  `userId` INT UNSIGNED NULL,
  PRIMARY KEY (`employeeId`),
  INDEX `userId_idx` (`userId` ASC),
  UNIQUE INDEX `userId_UNIQUE` (`userId` ASC),
  CONSTRAINT `userId`
    FOREIGN KEY (`userId`)
    REFERENCES `unltdmgmt`.`users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`employeeDetails`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`employeeDetails` (
  `employeeDetailsId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `employeeDetailsAddressStreet` VARCHAR(50) NULL,
  `employeeDetailsAddressCity` VARCHAR(45) NULL,
  `employeeDetailsAddressState` CHAR(2) NULL,
  `employeeDetailsAddressZip` SMALLINT NULL,
  `employeeDetailsFASA` VARCHAR(45) NULL,
  `employeeDetailsOSHA` VARCHAR(45) NULL,
  `employeeDetailshHourlyRate` TINYINT UNSIGNED NULL,
  `employeeDetailsIntenalNotes` TEXT NULL,
  `employeeId` INT UNSIGNED NULL,
  PRIMARY KEY (`employeeDetailsId`),
  UNIQUE INDEX `employeeId_UNIQUE` (`employeeId` ASC),
  CONSTRAINT `employeeId`
    FOREIGN KEY (`employeeId`)
    REFERENCES `unltdmgmt`.`employees` (`employeeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`projects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`projects` (
  `projectId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `projectName` VARCHAR(45) NOT NULL,
  `projectStartDate` DATE NOT NULL,
  `projectEndDate` DATE NOT NULL,
  `projectJobType` VARCHAR(45) NULL,
  `projectConstructionType` VARCHAR(45) NULL,
  `projectSizeSqft` INT UNSIGNED NULL,
  `projectAddressStreet` VARCHAR(60) NULL,
  `projectAddressCity` VARCHAR(45) NULL,
  `projectAddressState` CHAR(2) NULL,
  `projectAddressZip` INT NULL,
  `customerId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`projectId`),
  INDEX `customerId_idx` (`customerId` ASC),
  CONSTRAINT `customerId`
    FOREIGN KEY (`customerId`)
    REFERENCES `unltdmgmt`.`customers` (`customerId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`projectContacts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`projectContacts` (
  `projectContactsId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `projectContactFirstName` VARCHAR(45) NOT NULL,
  `projectContactLastName` VARCHAR(45) NULL,
  `projectContactEmail` VARCHAR(255) NULL,
  `projectContactPhone` VARCHAR(20) NULL,
  `projectContactPhoneExt` VARCHAR(10) NULL,
  `projectContactMobile` VARCHAR(20) NULL,
  `projectId` INT UNSIGNED NOT NULL COMMENT 'This are the external contacts regarding the project',
  PRIMARY KEY (`projectContactsId`),
  INDEX `projectId_idx` (`projectId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`itbs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`itbs` (
  `itbId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `itbDueDate` DATE NOT NULL,
  `itbSource` VARCHAR(45) NULL,
  `itbOnlineAccess` VARCHAR(100) NULL,
  `itbObservations` TEXT NULL,
  `projectId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`itbId`),
  UNIQUE INDEX `projectId_UNIQUE` (`projectId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`bids`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`bids` (
  `bidId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `bidNumber` INT UNSIGNED NOT NULL,
  `bidExtendedDueDate` DATE NULL,
  `bidAmount` DOUBLE(10,2) NOT NULL,
  `bidStatus` VARCHAR(30) NOT NULL,
  `bidConfidence` TINYINT UNSIGNED NULL,
  `bidMultipleGCs` TINYINT(1) NULL,
  `projectId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`bidId`),
  UNIQUE INDEX `bidNumber_UNIQUE` (`bidNumber` ASC),
  UNIQUE INDEX `projectId_UNIQUE` (`projectId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`projects_employees`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`projects_employees` (
  `projects_employees_Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `projectId` INT UNSIGNED NOT NULL,
  `employeeId` INT UNSIGNED NOT NULL,
  `projects_employee_position` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`projects_employees_Id`),
  INDEX `projectId_idx` (`projectId` ASC),
  INDEX `employeeId_idx` (`employeeId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `employeeId`
    FOREIGN KEY (`employeeId`)
    REFERENCES `unltdmgmt`.`employees` (`employeeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`costCodes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`costCodes` (
  `costCodesId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `costCodeAccount` INT UNSIGNED NOT NULL,
  `costCodeDescription` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`costCodesId`),
  UNIQUE INDEX `costCodeAccount_UNIQUE` (`costCodeAccount` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`projectBudgetItems`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`projectBudgetItems` (
  `projectBudgetItemId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `projectBudgetItemHours` DOUBLE(7,2) UNSIGNED NULL,
  `projectBudgetItemMaterialCost` DOUBLE(10,2) NULL,
  `projectId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`projectBudgetItemId`),
  INDEX `projectId_idx` (`projectId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`zones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`zones` (
  `zoneId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `zoneNumber` INT UNSIGNED NOT NULL,
  `zoneName` VARCHAR(45) NOT NULL,
  `zoneStatus` VARCHAR(30) NOT NULL DEFAULT 'Planning',
  `projectId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`zoneId`),
  INDEX `projectId_idx` (`projectId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`zoneBudgetItems`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`zoneBudgetItems` (
  `zoneBudgetItemId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `zoneBudgetItemHours` DOUBLE(7,2) UNSIGNED NULL,
  `zoneBudgetItemMaterialCost` DOUBLE(10,2) UNSIGNED NULL,
  `zoneId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`zoneBudgetItemId`),
  INDEX `zoneId_idx` (`zoneId` ASC),
  CONSTRAINT `zoneId`
    FOREIGN KEY (`zoneId`)
    REFERENCES `unltdmgmt`.`zones` (`zoneId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`rfps`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`rfps` (
  `rfpId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rfpProductLine` VARCHAR(30) NOT NULL,
  `rfpDueDate` DATE NOT NULL,
  `rfpObservations` TEXT NULL,
  `rfpFile` VARCHAR(45) NOT NULL,
  `rfpDateCreated` DATE NOT NULL,
  `projectId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`rfpId`),
  INDEX `projectId_idx` (`projectId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`projectBudget_costCodes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`projectBudget_costCodes` (
  `projectBudget_costCode_Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `projectBudgetId` INT UNSIGNED NOT NULL,
  `costCodeId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`projectBudget_costCode_Id`),
  INDEX `projectBudgetId_idx` (`projectBudgetId` ASC),
  INDEX `costCodeId_idx` (`costCodeId` ASC),
  CONSTRAINT `projectBudgetId`
    FOREIGN KEY (`projectBudgetId`)
    REFERENCES `unltdmgmt`.`projectBudgetItems` (`projectBudgetItemId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `costCodeId`
    FOREIGN KEY (`costCodeId`)
    REFERENCES `unltdmgmt`.`costCodes` (`costCodesId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`materialCategories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`materialCategories` (
  `materialCategorieId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `materialCategoryName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`materialCategorieId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`materialSubcategories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`materialSubcategories` (
  `materialSubcategoryId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `materialSubcategoryName` VARCHAR(45) NOT NULL,
  `materialCategoryId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`materialSubcategoryId`),
  INDEX `materialCategoryId_idx` (`materialCategoryId` ASC),
  CONSTRAINT `materialCategoryId`
    FOREIGN KEY (`materialCategoryId`)
    REFERENCES `unltdmgmt`.`materialCategories` (`materialCategorieId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`materialDescriptions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`materialDescriptions` (
  `materialDescriptionId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `materialDescriptionItem` VARCHAR(45) NOT NULL,
  `materialDescriptionUnit` VARCHAR(45) NULL,
  `materialSubcategoryId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`materialDescriptionId`),
  INDEX `materialSubcategoryId_idx` (`materialSubcategoryId` ASC),
  CONSTRAINT `materialSubcategoryId`
    FOREIGN KEY (`materialSubcategoryId`)
    REFERENCES `unltdmgmt`.`materialSubcategories` (`materialSubcategoryId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`eServiceJobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`eServiceJobs` (
  `eServiceJobId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `eServiceJobNumber` VARCHAR(10) NOT NULL,
  `eServiceJobType` CHAR(1) NOT NULL,
  `eServiceJobSiteType` VARCHAR(20) NOT NULL,
  `eServiceJobAddressStreet` VARCHAR(60) NOT NULL,
  `eServiceJobAddressCity` VARCHAR(45) NOT NULL,
  `eServiceJobAddressState` CHAR(2) NOT NULL,
  `eServiceJobAddressZip` INT NOT NULL,
  `customerId` INT UNSIGNED NOT NULL,
  `mainCustomerRepId` INT UNSIGNED NULL,
  PRIMARY KEY (`eServiceJobId`),
  UNIQUE INDEX `serviceJobNumber_UNIQUE` (`eServiceJobNumber` ASC),
  INDEX `customerId_idx` (`customerId` ASC),
  INDEX `mainCustomerRepId_idx` (`mainCustomerRepId` ASC),
  CONSTRAINT `customerId`
    FOREIGN KEY (`customerId`)
    REFERENCES `unltdmgmt`.`customers` (`customerId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `mainCustomerRepId`
    FOREIGN KEY (`mainCustomerRepId`)
    REFERENCES `unltdmgmt`.`customerReps` (`customerRepId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`eServiceRequests`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`eServiceRequests` (
  `eServiceRequestId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `eServiceRequestType` CHAR(1) NOT NULL,
  `eServiceRequestCustWO` VARCHAR(45) NULL,
  `eServiceRequestUECWO` VARCHAR(45) NULL,
  `eServiceRequestScope` TEXT NULL,
  `eServiceRequestStatus` VARCHAR(10) NULL,
  `eServiceRequestObservations` VARCHAR(255) NULL,
  `eServiceRequestBilling` VARCHAR(15) NULL,
  `eServiceRequestDepositRequest` DATE NULL,
  `eServiceRequestDepositReceived` DATE NULL,
  `eServiceRequestCODRequest` DATE NULL,
  `eServiceRequestCODReceived` DATE NULL,
  `eServiceRequestProposal` TINYINT(1) NULL,
  `eServiceJobId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`eServiceRequestId`),
  INDEX `serviceJobId_idx` (`eServiceJobId` ASC),
  CONSTRAINT `eServiceJobId`
    FOREIGN KEY (`eServiceJobId`)
    REFERENCES `unltdmgmt`.`eServiceJobs` (`eServiceJobId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`materialOrders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`materialOrders` (
  `materialOrderId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `materialOrderArea` VARCHAR(45) NOT NULL,
  `materialOrderSentVendor` TINYINT(1) NOT NULL DEFAULT 0,
  `materialOrderSentPM` TINYINT(1) NOT NULL DEFAULT 0,
  `materialOrderDate` DATE NOT NULL,
  `materialOrderObservations` TEXT NULL,
  `projectId` INT UNSIGNED NULL,
  `eServiceRequestId` INT UNSIGNED NULL,
  PRIMARY KEY (`materialOrderId`),
  INDEX `projectId_idx` (`projectId` ASC),
  INDEX `eServiceRequestId_idx` (`eServiceRequestId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `eServiceRequestId`
    FOREIGN KEY (`eServiceRequestId`)
    REFERENCES `unltdmgmt`.`eServiceRequests` (`eServiceRequestId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`materialOrders_vendors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`materialOrders_vendors` (
  `materialOrders_vendors_Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `materialOrderId` INT UNSIGNED NOT NULL,
  `vendorId` INT UNSIGNED NOT NULL,
  `materialOrders_vendors_Award` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`materialOrders_vendors_Id`),
  INDEX `materialOrderId_idx` (`materialOrderId` ASC),
  INDEX `vendorId_idx` (`vendorId` ASC),
  CONSTRAINT `materialOrderId`
    FOREIGN KEY (`materialOrderId`)
    REFERENCES `unltdmgmt`.`materialOrders` (`materialOrderId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `vendorId`
    FOREIGN KEY (`vendorId`)
    REFERENCES `unltdmgmt`.`vendors` (`vendorId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`materialOrderListItems`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`materialOrderListItems` (
  `materialOrderListItemId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `materialOrderListItemQuantity` INT UNSIGNED NOT NULL DEFAULT 0,
  `materialOrderListItemDelivered` INT UNSIGNED NOT NULL DEFAULT 0,
  `materialOrderListItemComments` VARCHAR(255) NULL,
  `materialOrderId` INT UNSIGNED NOT NULL,
  `materialDescriptionId` INT UNSIGNED NOT NULL,
  `costCodeId` INT UNSIGNED NOT NULL,
  `zoneId` INT UNSIGNED NULL,
  PRIMARY KEY (`materialOrderListItemId`),
  INDEX `materialOrderId_idx` (`materialOrderId` ASC),
  INDEX `materialDescriptionId_idx` (`materialDescriptionId` ASC),
  INDEX `costCodeId_idx` (`costCodeId` ASC),
  INDEX `zoneId_idx` (`zoneId` ASC),
  CONSTRAINT `materialOrderId`
    FOREIGN KEY (`materialOrderId`)
    REFERENCES `unltdmgmt`.`materialOrders` (`materialOrderId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materialDescriptionId`
    FOREIGN KEY (`materialDescriptionId`)
    REFERENCES `unltdmgmt`.`materialDescriptions` (`materialDescriptionId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `costCodeId`
    FOREIGN KEY (`costCodeId`)
    REFERENCES `unltdmgmt`.`costCodes` (`costCodesId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `zoneId`
    FOREIGN KEY (`zoneId`)
    REFERENCES `unltdmgmt`.`zones` (`zoneId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`materialBuyouts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`materialBuyouts` (
  `materialBuyoutId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `materialBuyoutArea` VARCHAR(45) NOT NULL,
  `materialBuyoutSentVendor` TINYINT(1) NOT NULL DEFAULT 0,
  `materialBuyoutSentPM` TINYINT(1) NOT NULL DEFAULT 0,
  `materialBuyoutObservations` TEXT NULL,
  `projectId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`materialBuyoutId`),
  INDEX `projectId_idx` (`projectId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`materialBuyoutListItems`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`materialBuyoutListItems` (
  `materialBuyoutListItemId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `materialBuyoutListItemQuantity` INT UNSIGNED NOT NULL DEFAULT 0,
  `materialBuyoutListItemDelivered` INT UNSIGNED NOT NULL DEFAULT 0,
  `materialBuyoutListItemComments` VARCHAR(255) NULL,
  `materialBuyoutId` INT UNSIGNED NOT NULL,
  `materialDescriptionId` INT UNSIGNED NOT NULL,
  `costCodeId` INT UNSIGNED NOT NULL,
  `zoneId` INT UNSIGNED NULL,
  PRIMARY KEY (`materialBuyoutListItemId`),
  INDEX `materialDescriptionId_idx` (`materialDescriptionId` ASC),
  INDEX `costCodeId_idx` (`costCodeId` ASC),
  INDEX `zoneId_idx` (`zoneId` ASC),
  INDEX `materialBuyoutId_idx` (`materialBuyoutId` ASC),
  CONSTRAINT `materialBuyoutId`
    FOREIGN KEY (`materialBuyoutId`)
    REFERENCES `unltdmgmt`.`materialBuyouts` (`materialBuyoutId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materialDescriptionId`
    FOREIGN KEY (`materialDescriptionId`)
    REFERENCES `unltdmgmt`.`materialDescriptions` (`materialDescriptionId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `costCodeId`
    FOREIGN KEY (`costCodeId`)
    REFERENCES `unltdmgmt`.`costCodes` (`costCodesId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `zoneId`
    FOREIGN KEY (`zoneId`)
    REFERENCES `unltdmgmt`.`zones` (`zoneId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`materialBuyoutReleases`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`materialBuyoutReleases` (
  `materialBuyoutReleaseId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `materialBuyoutReleaseNumber` TINYINT UNSIGNED NOT NULL,
  `materialBuyoutReleaseQuantity` INT UNSIGNED NOT NULL,
  `materialBuyoutReleaseDate` DATE NULL,
  `materialBuyoutReleaseBackOrder` INT UNSIGNED NULL,
  `materialBuyoutId` INT UNSIGNED NOT NULL,
  `materialBuyoutListItemId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`materialBuyoutReleaseId`),
  INDEX `materialBuyoutId_idx` (`materialBuyoutId` ASC),
  INDEX `buyoutListItemId_idx` (`materialBuyoutListItemId` ASC),
  UNIQUE INDEX `materialBuyoutReleaseNumber_UNIQUE` (`materialBuyoutReleaseNumber` ASC),
  CONSTRAINT `materialBuyoutId`
    FOREIGN KEY (`materialBuyoutId`)
    REFERENCES `unltdmgmt`.`materialBuyouts` (`materialBuyoutId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materialBuyoutListItemId`
    FOREIGN KEY (`materialBuyoutListItemId`)
    REFERENCES `unltdmgmt`.`materialBuyoutListItems` (`materialBuyoutListItemId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`lightingBuyouts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`lightingBuyouts` (
  `lightingBuyoutId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lightingBuyoutDescription` VARCHAR(45) NOT NULL,
  `lightingBuyoutStatus` VARCHAR(20) NULL,
  `lightingBuyoutSentVendor` TINYINT(1) NOT NULL DEFAULT 0,
  `lightingBuyoutSentPM` TINYINT(1) NOT NULL DEFAULT 0,
  `lightingBuyoutObservations` TEXT NULL,
  `projectId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`lightingBuyoutId`),
  INDEX `projectId_idx` (`projectId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`lightingFixtures`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`lightingFixtures` (
  `lightingFixtureId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lightingFixtureQuantity` INT UNSIGNED NOT NULL,
  `lightingFixtureUnit` VARCHAR(10) NULL,
  `lightingFixtureType` VARCHAR(45) NULL,
  `lightingFixtureManufacturer` VARCHAR(45) NULL,
  `lightingFixtureDescription` VARCHAR(60) NULL,
  `lightingFixtureCatalogNumber` VARCHAR(60) NULL,
  `lightingFixtureAlternative` TINYINT(1) NOT NULL DEFAULT 0,
  `lightingFixtureNotes` VARCHAR(255) NULL,
  `lightingFixturePicture` VARCHAR(255) NULL,
  `lightingBuyoutId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`lightingFixtureId`),
  INDEX `lightingBuyoutId_idx` (`lightingBuyoutId` ASC),
  CONSTRAINT `lightingBuyoutId`
    FOREIGN KEY (`lightingBuyoutId`)
    REFERENCES `unltdmgmt`.`lightingBuyouts` (`lightingBuyoutId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`lightingFixtureParts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`lightingFixtureParts` (
  `lightingFixturePartId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lightingFixturePartCategory` VARCHAR(15) NOT NULL,
  `lightingFixturePartType` VARCHAR(45) NULL,
  `lightingFixturePartQuantity` INT UNSIGNED NOT NULL,
  `lightingFixtureId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`lightingFixturePartId`),
  INDEX `fixtureId_idx` (`lightingFixtureId` ASC),
  CONSTRAINT `lightingFixtureId`
    FOREIGN KEY (`lightingFixtureId`)
    REFERENCES `unltdmgmt`.`lightingFixtures` (`lightingFixtureId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`lightingReleases`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`lightingReleases` (
  `lightingReleaseId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lightingReleaseNumber` INT UNSIGNED NOT NULL,
  `lightingReleaseWholeFixture` INT UNSIGNED NULL,
  `lightingFixtureId` INT UNSIGNED NOT NULL,
  `lightingFixturePartId` INT UNSIGNED NULL,
  PRIMARY KEY (`lightingReleaseId`),
  INDEX `fixtureId_idx` (`lightingFixtureId` ASC),
  INDEX `fixturePartId_idx` (`lightingFixturePartId` ASC),
  CONSTRAINT `lightingFixtureId`
    FOREIGN KEY (`lightingFixtureId`)
    REFERENCES `unltdmgmt`.`lightingFixtures` (`lightingFixtureId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lightingFixturePartId`
    FOREIGN KEY (`lightingFixturePartId`)
    REFERENCES `unltdmgmt`.`lightingFixtureParts` (`lightingFixturePartId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`packingSlips`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`packingSlips` (
  `packingSlipsId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `packingSlipFile` VARCHAR(255) NOT NULL,
  `packingSlipReviewed` TINYINT(1) NOT NULL DEFAULT 0,
  `materialOrderId` INT UNSIGNED NULL,
  `materialBuyoutReleaseId` INT UNSIGNED NULL,
  `lightingReleaseId` INT UNSIGNED NULL,
  PRIMARY KEY (`packingSlipsId`),
  INDEX `materialOrderId_idx` (`materialOrderId` ASC),
  INDEX `lightingReleaseId_idx` (`lightingReleaseId` ASC),
  INDEX `materialBuyoutReleaseId_idx` (`materialBuyoutReleaseId` ASC),
  CONSTRAINT `materialOrderId`
    FOREIGN KEY (`materialOrderId`)
    REFERENCES `unltdmgmt`.`materialOrders` (`materialOrderId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materialBuyoutReleaseId`
    FOREIGN KEY (`materialBuyoutReleaseId`)
    REFERENCES `unltdmgmt`.`materialBuyoutReleases` (`materialBuyoutReleaseId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lightingReleaseId`
    FOREIGN KEY (`lightingReleaseId`)
    REFERENCES `unltdmgmt`.`lightingReleases` (`lightingReleaseId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`dailyReports`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`dailyReports` (
  `dailyReportId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `dailyReportDate` DATE NOT NULL,
  `dailyReportUecWorkers` TINYINT NULL,
  `dailyReportPieceWorkers` TINYINT NULL,
  `dailyReportSuperintComments` TEXT NULL,
  `dailyReportManPowerSent` TINYINT(1) NULL,
  `dailyReportRentalEquipment` VARCHAR(255) NULL,
  `dailyReportTempLabor` VARCHAR(255) NULL,
  `dailyReportSubcontractors` VARCHAR(255) NULL,
  `dailyReportWeather` VARCHAR(255) NULL,
  `dailyReportBackOrders` VARCHAR(255) NULL,
  `dailyReportActivities` TEXT NULL,
  `dailyReportDelays` VARCHAR(255) NULL,
  `dailyReportExtraWork` VARCHAR(255) NULL,
  `projectId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`dailyReportId`),
  INDEX `projectId_idx` (`projectId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`fileAttachments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`fileAttachments` (
  `fileAttachmentId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fileAttachmentName` VARCHAR(45) NULL,
  `fileAttachmentFile` VARCHAR(225) NOT NULL,
  `materialOrderId` INT UNSIGNED NULL,
  `materialBuyoutId` INT UNSIGNED NULL,
  `dailyReportId` INT UNSIGNED NULL,
  PRIMARY KEY (`fileAttachmentId`),
  INDEX `materialOrderId_idx` (`materialOrderId` ASC),
  INDEX `materialBuyoutId_idx` (`materialBuyoutId` ASC),
  INDEX `dailyReportId_idx` (`dailyReportId` ASC),
  CONSTRAINT `materialOrderId`
    FOREIGN KEY (`materialOrderId`)
    REFERENCES `unltdmgmt`.`materialOrders` (`materialOrderId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materialBuyoutId`
    FOREIGN KEY (`materialBuyoutId`)
    REFERENCES `unltdmgmt`.`materialBuyouts` (`materialBuyoutId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `dailyReportId`
    FOREIGN KEY (`dailyReportId`)
    REFERENCES `unltdmgmt`.`dailyReports` (`dailyReportId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`materialBuyouts_vendors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`materialBuyouts_vendors` (
  `materialBuyouts_vendors_Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `materialBuyoutId` INT UNSIGNED NOT NULL,
  `vendorId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`materialBuyouts_vendors_Id`),
  INDEX `vendorId_idx` (`vendorId` ASC),
  INDEX `materialBuyoutId_idx` (`materialBuyoutId` ASC),
  CONSTRAINT `materialBuyoutId`
    FOREIGN KEY (`materialBuyoutId`)
    REFERENCES `unltdmgmt`.`materialBuyouts` (`materialBuyoutId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `vendorId`
    FOREIGN KEY (`vendorId`)
    REFERENCES `unltdmgmt`.`vendors` (`vendorId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`lightingBuyouts_vendors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`lightingBuyouts_vendors` (
  `lightingBuyouts_vendors_Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lightingBuyoutId` INT UNSIGNED NOT NULL,
  `vendorId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`lightingBuyouts_vendors_Id`),
  INDEX `lightingBuyoutId_idx` (`lightingBuyoutId` ASC),
  INDEX `vendorId_idx` (`vendorId` ASC),
  CONSTRAINT `lightingBuyoutId`
    FOREIGN KEY (`lightingBuyoutId`)
    REFERENCES `unltdmgmt`.`lightingBuyouts` (`lightingBuyoutId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `vendorId`
    FOREIGN KEY (`vendorId`)
    REFERENCES `unltdmgmt`.`vendors` (`vendorId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`quotes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`quotes` (
  `quoteId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `quotePO` INT UNSIGNED NULL,
  `quoteObservations` TEXT NULL,
  `quoteDecision` CHAR(1) NOT NULL DEFAULT 'N',
  `quoteAmount` INT NULL,
  `quoteFile` VARCHAR(255) NULL,
  `rfpId` INT UNSIGNED NOT NULL,
  `materialOrders_vendors_Id` INT UNSIGNED NULL,
  `materialBuyouts_vendors_Id` INT UNSIGNED NULL,
  `lightingBuyouts_vendors_Id` INT UNSIGNED NULL,
  PRIMARY KEY (`quoteId`),
  UNIQUE INDEX `quotePO_UNIQUE` (`quotePO` ASC),
  INDEX `rfpId_idx` (`rfpId` ASC),
  INDEX `materialBuyouts_vendors_Id_idx` (`materialBuyouts_vendors_Id` ASC),
  INDEX `materialOrders_vendors_Id_idx` (`materialOrders_vendors_Id` ASC),
  INDEX `lightingBuyouts_vendors_Id_idx` (`lightingBuyouts_vendors_Id` ASC),
  CONSTRAINT `rfpId`
    FOREIGN KEY (`rfpId`)
    REFERENCES `unltdmgmt`.`rfps` (`rfpId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materialBuyouts_vendors_Id`
    FOREIGN KEY (`materialBuyouts_vendors_Id`)
    REFERENCES `unltdmgmt`.`materialBuyouts_vendors` (`materialBuyouts_vendors_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `materialOrders_vendors_Id`
    FOREIGN KEY (`materialOrders_vendors_Id`)
    REFERENCES `unltdmgmt`.`materialOrders_vendors` (`materialOrders_vendors_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lightingBuyouts_vendors_Id`
    FOREIGN KEY (`lightingBuyouts_vendors_Id`)
    REFERENCES `unltdmgmt`.`lightingBuyouts_vendors` (`lightingBuyouts_vendors_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`timeSheets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`timeSheets` (
  `timeSheetsId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `timeSheetLunchHours` TIME NOT NULL DEFAULT 00:30:00,
  `timeSheetRealStartTime` TIMESTAMP NOT NULL,
  `timeSheetStartTime` TIME NOT NULL,
  `timeSheetRealEndTime` TIMESTAMP NOT NULL,
  `timeSheetEndTime` TIME NOT NULL,
  `timeSheetClockinPic` VARCHAR(255) NULL,
  `timeSheetClockoutPic` VARCHAR(255) NULL,
  `projectId` INT UNSIGNED NOT NULL,
  `employeeId` INT UNSIGNED NOT NULL,
  `dailyReportId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`timeSheetsId`),
  INDEX `projectId_idx` (`projectId` ASC),
  INDEX `employeeId_idx` (`employeeId` ASC),
  INDEX `dailyReportId_idx` (`dailyReportId` ASC),
  CONSTRAINT `projectId`
    FOREIGN KEY (`projectId`)
    REFERENCES `unltdmgmt`.`projects` (`projectId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `employeeId`
    FOREIGN KEY (`employeeId`)
    REFERENCES `unltdmgmt`.`employees` (`employeeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `dailyReportId`
    FOREIGN KEY (`dailyReportId`)
    REFERENCES `unltdmgmt`.`dailyReports` (`dailyReportId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`timeSheets_costCodes_zones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`timeSheets_costCodes_zones` (
  `timeSheets_costCode_zones_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `timeSheetId` INT UNSIGNED NOT NULL,
  `costCodeId` INT UNSIGNED NOT NULL,
  `zoneId` INT UNSIGNED NULL,
  `timeSheetHoursWorked` TIME NOT NULL,
  PRIMARY KEY (`timeSheets_costCode_zones_id`),
  INDEX `timeSheetId_idx` (`timeSheetId` ASC),
  INDEX `costCodeId_idx` (`costCodeId` ASC),
  INDEX `zoneId_idx` (`zoneId` ASC),
  CONSTRAINT `timeSheetId`
    FOREIGN KEY (`timeSheetId`)
    REFERENCES `unltdmgmt`.`timeSheets` (`timeSheetsId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `costCodeId`
    FOREIGN KEY (`costCodeId`)
    REFERENCES `unltdmgmt`.`costCodes` (`costCodesId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `zoneId`
    FOREIGN KEY (`zoneId`)
    REFERENCES `unltdmgmt`.`zones` (`zoneId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`jobApplications`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`jobApplications` (
  `jobApplicationId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `jobApplicationDate` DATE NOT NULL,
  `jobApplicationSignature` VARCHAR(45) NOT NULL,
  `jobApplicationSignatureDate` DATE NULL,
  `jobApplicationW4` BLOB NULL,
  `jobApplicationI9` BLOB NULL,
  PRIMARY KEY (`jobApplicationId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`applicantInfo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`applicantInfo` (
  `applicantInfoId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `applicantInfoFirstName` VARCHAR(20) NOT NULL,
  `applicantInfoLastName` VARCHAR(20) NOT NULL,
  `applicantInfoMiddleName` VARCHAR(20) NULL,
  `applicantInfoPhone` VARCHAR(20) NULL,
  `applicantInfoEmail` VARCHAR(255) NULL,
  `applicantInfoSocialSecurity` VARCHAR(20) NULL,
  `applicantInfoAddressStreet` VARCHAR(60) NULL,
  `applicantInfoAddressCity` VARCHAR(45) NULL,
  `applicantInfoAddressState` CHAR(2) NULL,
  `applicantInfoAddressZip` INT NULL,
  `jobApplicationId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`applicantInfoId`),
  UNIQUE INDEX `jobApplication_UNIQUE` (`jobApplicationId` ASC),
  CONSTRAINT `jobApplicationId`
    FOREIGN KEY (`jobApplicationId`)
    REFERENCES `unltdmgmt`.`jobApplications` (`jobApplicationId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`applicationInfo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`applicationInfo` (
  `applicationInfoId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `applicationInfoPosition` VARCHAR(20) NULL,
  `applicationInfoSource` VARCHAR(20) NULL,
  `applicationInfoDateAvail` DATE NULL,
  `applicationInfoRequiredSalary` DOUBLE NULL,
  `applicationInfoInterests` TEXT NULL,
  `applicationInfoConvicted` TINYINT(1) NULL,
  `applicationInfoConvictedExplain` VARCHAR(255) NULL,
  `applicationInfoCitizen` TINYINT(1) NULL,
  `applicationInfoWorkAuthorized` TINYINT(1) NULL,
  `jobApplicationId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`applicationInfoId`),
  INDEX `jobApplicationId_idx` (`jobApplicationId` ASC),
  UNIQUE INDEX `jobApplicationId_UNIQUE` (`jobApplicationId` ASC),
  CONSTRAINT `jobApplicationId`
    FOREIGN KEY (`jobApplicationId`)
    REFERENCES `unltdmgmt`.`jobApplications` (`jobApplicationId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`employmentHistory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`employmentHistory` (
  `employmentHistoryId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `employmentHistoryCompany` VARCHAR(60) NULL,
  `employmentHistoryAddress` VARCHAR(255) NULL,
  `employmentHistoryPhone` VARCHAR(20) NULL,
  `employmentHistorySupervisor` VARCHAR(20) NULL,
  `employmentHistoryFrom` DATE NULL,
  `employmentHistoryTo` DATE NULL,
  `employmentHistoryStartingSalary` DOUBLE NULL,
  `employmentHistoryEndingSalary` DOUBLE NULL,
  `employmentHistoryDuties` VARCHAR(255) NULL,
  `employmentHistoryLeavingReason` VARCHAR(255) NULL,
  `employmentHistoryChangeReason` VARCHAR(255) NULL,
  `employmentHistoryCallEmployer` TINYINT(1) NULL,
  `jobApplicationId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`employmentHistoryId`),
  UNIQUE INDEX `jobApplicationId_UNIQUE` (`jobApplicationId` ASC),
  CONSTRAINT `jobApplicationId`
    FOREIGN KEY (`jobApplicationId`)
    REFERENCES `unltdmgmt`.`jobApplications` (`jobApplicationId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`jobApplicationReferences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`jobApplicationReferences` (
  `jobApplicationReferenceId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `jobApplicationReferenceName` VARCHAR(100) NULL,
  `jobApplicationReferenceAddress` VARCHAR(255) NULL,
  `jobApplicationReferencePhone` VARCHAR(20) NULL,
  `jobApplicationReferenceRelationship` VARCHAR(45) NULL,
  `jobApplicationId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`jobApplicationReferenceId`),
  UNIQUE INDEX `jobApplicationId_UNIQUE` (`jobApplicationId` ASC),
  CONSTRAINT `jobApplicationId`
    FOREIGN KEY (`jobApplicationId`)
    REFERENCES `unltdmgmt`.`jobApplications` (`jobApplicationId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`educationHistory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`educationHistory` (
  `educationHistoryId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `educationHistoryInstitution` VARCHAR(45) NULL,
  `educationHistoryCourse` VARCHAR(45) NULL,
  `educationHistoryYearsCompleted` TINYINT UNSIGNED NULL,
  `educationHistoryGraduated` TINYINT(1) NULL,
  `educationHistoryDegree` VARCHAR(45) NULL,
  `educationHistoryNotGrad` VARCHAR(255) NULL,
  `educationHistoryFutureStudy` TINYINT(1) NULL,
  `jobApplicationId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`educationHistoryId`),
  UNIQUE INDEX `jobApplicationId_UNIQUE` (`jobApplicationId` ASC),
  CONSTRAINT `jobApplicationId`
    FOREIGN KEY (`jobApplicationId`)
    REFERENCES `unltdmgmt`.`jobApplications` (`jobApplicationId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`jobAgreements`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`jobAgreements` (
  `jobAgreementId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `jobAgreementSignature` VARCHAR(45) NULL,
  `jobAgreementSignDate` DATE NULL,
  `jobAgreementHandbookSign` VARCHAR(45) NULL,
  `jobAgreementHandbSignDate` DATE NULL,
  `jobApplicationId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`jobAgreementId`),
  UNIQUE INDEX `jobApplicationId_UNIQUE` (`jobApplicationId` ASC),
  CONSTRAINT `jobApplicationId`
    FOREIGN KEY (`jobApplicationId`)
    REFERENCES `unltdmgmt`.`jobApplications` (`jobApplicationId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`testQuestions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`testQuestions` (
  `testQuestionId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `testQuestionQuestion` VARCHAR(255) NOT NULL,
  `testQuestionAnswerA` VARCHAR(255) NOT NULL,
  `testQuestionAnswerB` VARCHAR(255) NOT NULL,
  `testQuestionAnswerC` VARCHAR(255) NOT NULL,
  `testQuestionAnswerD` VARCHAR(255) NOT NULL,
  `testQuestionCorrect` CHAR(1) NOT NULL,
  `testQuestionType` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`testQuestionId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`employeeTests`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`employeeTests` (
  `employeeTestId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `employeeTestTry` TINYINT UNSIGNED NOT NULL,
  `employeeTestDate` DATE NOT NULL,
  `employeeTestQuestion` TINYINT UNSIGNED NOT NULL,
  `employeeTestAnswer` CHAR(1) NULL,
  `jobApplicationId` INT UNSIGNED NULL,
  `testQuestionId` INT UNSIGNED NOT NULL,
  `employeeId` INT UNSIGNED NULL,
  PRIMARY KEY (`employeeTestId`),
  INDEX `jobApplicationId_idx` (`jobApplicationId` ASC),
  INDEX `testQuestionId_idx` (`testQuestionId` ASC),
  INDEX `employeeId_idx` (`employeeId` ASC),
  CONSTRAINT `jobApplicationId`
    FOREIGN KEY (`jobApplicationId`)
    REFERENCES `unltdmgmt`.`jobApplications` (`jobApplicationId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `testQuestionId`
    FOREIGN KEY (`testQuestionId`)
    REFERENCES `unltdmgmt`.`testQuestions` (`testQuestionId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `employeeId`
    FOREIGN KEY (`employeeId`)
    REFERENCES `unltdmgmt`.`employees` (`employeeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`healthCenters`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`healthCenters` (
  `healthCenterId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `healthCenterName` VARCHAR(60) NULL,
  `healthCenterAddressStreet` VARCHAR(60) NULL,
  `healthCenterAdressCity` VARCHAR(20) NULL,
  `healthCenterAddressState` CHAR(2) NULL,
  `healthCenterAddressZip` INT NULL,
  `healthCenterPhone` VARCHAR(20) NULL,
  `healthCenterHours` VARCHAR(255) NULL,
  PRIMARY KEY (`healthCenterId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`vehicles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`vehicles` (
  `vehicleId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicleMake` VARCHAR(10) NOT NULL,
  `vehicleModel` VARCHAR(10) NOT NULL,
  `vehicleVinNumber` VARCHAR(45) NOT NULL,
  `vehicleLicencePlate` VARCHAR(10) NULL,
  `vehicleLastService` DATE NULL,
  `vehicleOdometer` MEDIUMINT NULL,
  `vehicleNextService` DATE NULL,
  `employeeId` INT UNSIGNED NULL,
  PRIMARY KEY (`vehicleId`),
  INDEX `employeeId_idx` (`employeeId` ASC),
  CONSTRAINT `employeeId`
    FOREIGN KEY (`employeeId`)
    REFERENCES `unltdmgmt`.`employees` (`employeeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`eServiceDispatches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`eServiceDispatches` (
  `eServiceDispatchId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `eServiceDispatchDate` DATE NOT NULL,
  `eServiceDispatchTime` TIME NOT NULL,
  `eServiceDispatchObservations` VARCHAR(255) NULL,
  `eServiceDispatchClockin` DATETIME NULL,
  `eServiceDispatchClockout` DATETIME NULL,
  `eServiceDispatchClockinLatitude` DOUBLE(3,15) NULL,
  `eServiceDispatchClockinLongitude` DOUBLE(3,15) NULL,
  `eServiceDispatchClockoutLatitude` DOUBLE(3,15) NULL,
  `eServiceDispatchClockoutLongitude` DOUBLE(3,15) NULL,
  `eServiceDispatchEndDay` TINYINT(1) NOT NULL DEFAULT 0,
  `eServiceDispatchParts` TINYINT(1) NOT NULL DEFAULT 0,
  `eServiceRequestId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`eServiceDispatchId`),
  INDEX `eServiceRequestId_idx` (`eServiceRequestId` ASC),
  CONSTRAINT `eServiceRequestId`
    FOREIGN KEY (`eServiceRequestId`)
    REFERENCES `unltdmgmt`.`eServiceRequests` (`eServiceRequestId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`avServiceJobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`avServiceJobs` (
  `avServiceJobId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `avServiceJobNumber` VARCHAR(10) NOT NULL,
  `avServiceJobType` CHAR(1) NOT NULL,
  `avServiceJobSiteType` VARCHAR(20) NOT NULL,
  `avServiceJobAddressStreet` VARCHAR(60) NOT NULL,
  `avServiceJobAddressCity` VARCHAR(45) NOT NULL,
  `avServiceJobAddressState` CHAR(2) NOT NULL,
  `avServiceJobAddressZip` INT NOT NULL,
  `customerId` INT UNSIGNED NOT NULL,
  `mainCustomerRepId` INT UNSIGNED NULL,
  PRIMARY KEY (`avServiceJobId`),
  UNIQUE INDEX `serviceJobNumber_UNIQUE` (`avServiceJobNumber` ASC),
  INDEX `customerId_idx` (`customerId` ASC),
  INDEX `mainCustomerRepId_idx` (`mainCustomerRepId` ASC),
  CONSTRAINT `customerId0`
    FOREIGN KEY (`customerId`)
    REFERENCES `unltdmgmt`.`customers` (`customerId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `mainCustomerRepId0`
    FOREIGN KEY (`mainCustomerRepId`)
    REFERENCES `unltdmgmt`.`customerReps` (`customerRepId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`avServiceRequests`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`avServiceRequests` (
  `avServiceRequestId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `avServiceRequestType` CHAR(1) NOT NULL,
  `avServiceRequestCustWO` VARCHAR(45) NULL,
  `avServiceRequestUECWO` VARCHAR(45) NULL,
  `avServiceRequestScope` TEXT NULL,
  `avServiceRequestStatus` VARCHAR(10) NULL,
  `avServiceRequestObservations` VARCHAR(255) NULL,
  `avServiceRequestBilling` VARCHAR(15) NULL,
  `avServiceRequestDepositRequest` DATE NULL,
  `avServiceRequestDepositReceived` DATE NULL,
  `avServiceRequestCODRequest` DATE NULL,
  `avServiceRequestCODReceived` DATE NULL,
  `avServiceRequestProposal` TINYINT(1) NULL,
  `avServiceJobId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`avServiceRequestId`),
  INDEX `AVServiceJobId_idx` (`avServiceJobId` ASC),
  CONSTRAINT `avServiceJobId`
    FOREIGN KEY (`avServiceJobId`)
    REFERENCES `unltdmgmt`.`avServiceJobs` (`avServiceJobId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`avServiceInvoices`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`avServiceInvoices` (
  `avServiceInvoiceId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `avServiceInvoicePartial` TINYINT(1) NULL,
  `avServiceInvoiceDate` DATE NULL,
  `avServiceInvoiceTerms` DATE NULL,
  `avServiceInvoiceCustEmail` TINYINT(1) NULL,
  `avServiceInvoicePaymentReceived` TINYINT(1) NULL,
  `avServiceRequestId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`avServiceInvoiceId`),
  INDEX `avServiceRequestId_idx` (`avServiceRequestId` ASC),
  CONSTRAINT `avServiceRequestId`
    FOREIGN KEY (`avServiceRequestId`)
    REFERENCES `unltdmgmt`.`avServiceRequests` (`avServiceRequestId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`avServiceDispatches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`avServiceDispatches` (
  `avServiceDispatchId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `avServiceDispatchDate` DATE NOT NULL,
  `avServiceDispatchTime` TIME NOT NULL,
  `avServiceDispatchObservations` VARCHAR(255) NULL,
  `avServiceDispatchClockin` DATETIME NULL,
  `avServiceDispatchClockout` DATETIME NULL,
  `avServiceDispatchClockinLatitude` DOUBLE(3,15) NULL,
  `avServiceDispatchClockinLongitude` DOUBLE(3,15) NULL,
  `avServiceDispatchClockoutLatitude` DOUBLE(3,15) NULL,
  `avServiceDispatchClockoutLongitude` DOUBLE(3,15) NULL,
  `avServiceDispatchEndDay` TINYINT(1) NOT NULL DEFAULT 0,
  `avServiceDispatchParts` TINYINT(1) NOT NULL DEFAULT 0,
  `avServiceRequestId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`avServiceDispatchId`),
  INDEX `avServiceRequestId_idx` (`avServiceRequestId` ASC),
  CONSTRAINT `avServiceRequestId`
    FOREIGN KEY (`avServiceRequestId`)
    REFERENCES `unltdmgmt`.`avServiceRequests` (`avServiceRequestId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unltdmgmt`.`eServiceInvoices`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unltdmgmt`.`eServiceInvoices` (
  `eServiceInvoiceId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `eServiceInvoicePartial` TINYINT(1) NULL,
  `eServiceInvoiceDate` DATE NULL,
  `eServiceInvoiceTerms` DATE NULL,
  `eServiceInvoiceCustEmail` TINYINT(1) NULL,
  `eServiceInvoicePaymentReceived` TINYINT(1) NULL,
  `eServiceRequestId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`eServiceInvoiceId`),
  INDEX `eServiceRequestId_idx` (`eServiceRequestId` ASC),
  CONSTRAINT `eServiceRequestId1`
    FOREIGN KEY (`eServiceRequestId`)
    REFERENCES `unltdmgmt`.`eServiceRequests` (`eServiceRequestId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
