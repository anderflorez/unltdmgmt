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
	$sql = "INSERT INTO users (username, email, password, firstName, lastName, company, status)
			VALUES ('administrator', ' ', '{$adminpass}', ' ', ' ', 'Unlimited Companies', 'active')";
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


	//Create table for employees
	$sql = "CREATE TABLE IF NOT EXISTS employees (
			employeeId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			employeeMobilePhone VARCHAR(20) NULL,
			employeePosition VARCHAR(20) NOT NULL,
			employeeStartDate DATE NOT NULL,
			employeeTerminationDate DATE NULL,
			employeeSkills TEXT NULL,
			userId INT UNSIGNED NULL UNIQUE,
			PRIMARY KEY (employeeId),
			FOREIGN KEY (userId) REFERENCES users (userId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table employees has been created successfully<br>";
	}
	else {
		echo "Error creating the table employees: " . $db->error . "<br>";
	}


	//Create table for employee details
	$sql = "CREATE TABLE IF NOT EXISTS employeeDetails (
	employeeDetailsId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	employeeDetailsStreet VARCHAR(128) NULL,
	employeeDetailsCity VARCHAR(50) NULL,
	employeeDetailsState CHAR(2) NULL,
	employeeDetailsZip VARCHAR(10) NULL,
	employeeDetailsFASA VARCHAR(255) NULL,
	employeeDetailsOSHA VARCHAR(255) NULL,
	employeeDetailshHourlyRate TINYINT UNSIGNED NULL,
	employeeDetailsIntenalNotes TEXT NULL,
	employeeId INT UNSIGNED NULL UNIQUE,
	PRIMARY KEY (employeeDetailsId),
	FOREIGN KEY (employeeId) REFERENCES employees (employeeId)
	) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table employeeDetails has been created successfully<br>";
	}
	else {
		echo "Error creating the table employeeDetails: " . $db->error . "<br>";
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
			customerStreet VARCHAR(128) NULL,
			customerCity VARCHAR(50) NULL,
			customerState CHAR(2) NULL,
			customerZip VARCHAR(10) NULL,
			userId INT UNSIGNED NULL UNIQUE,
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
	$sql = "CREATE TABLE IF NOT EXISTS vendors (
			vendorId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			vendorName VARCHAR(50) NOT NULL,
			vendorProductLine VARCHAR(50) NOT NULL,
			vendorEmail VARCHAR(255) NOT NULL,
			vendorPhone VARCHAR(20) NULL,
			vendorPhoneExt VARCHAR(10) NULL,
			vendorFax VARCHAR(20) NULL,
			vendorStreet VARCHAR(128) NULL,
			vendorCity VARCHAR(50) NULL,
			vendorState CHAR(2) NULL,
			vendorZipCode VARCHAR(10) NULL,
			vendorWebsite VARCHAR(255) NULL,
			userId INT UNSIGNED NULL UNIQUE,
			PRIMARY KEY (vendorId),
			FOREIGN KEY (userId) REFERENCES users(userId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table vendors has been created successfully<br>";
	}
	else {
		echo "Error creating the table vendors: " . $db->error . "<br>";
	}


	//Create table for vendor representatives
	$sql = "CREATE TABLE IF NOT EXISTS vendorReps (
			vendorRepId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			vendorRepFirstName VARCHAR(50) NOT NULL,
			vendorRepLastName VARCHAR(50) NULL,
			vendorRepEmail VARCHAR(255) NOT NULL,
			vendorRepPhone VARCHAR(20) NULL,
			vendorRepPhoneExt VARCHAR(10) NULL,
			vendorRepMobile VARCHAR(20) NULL,
			vendorId INT UNSIGNED NOT NULL,
			PRIMARY KEY (vendorRepId),
			FOREIGN KEY (vendorId) REFERENCES vendors (vendorId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table vendorReps has been created successfully<br>";
	}
	else {
		echo "Error creating the table vendorReps: " . $db->error . "<br>";
	}


	//Create table for cost codes
	$sql = "CREATE TABLE IF NOT EXISTS costCodes (
			costCodesId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			costCodeAccount INT UNSIGNED NOT NULL UNIQUE,
			costCodeDescription VARCHAR(255) NOT NULL,
			PRIMARY KEY (costCodesId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table costCodes has been created successfully<br>";
	}
	else {
		echo "Error creating the table costCodes: " . $db->error . "<br>";
	}


	//Create table projects
	$sql = "CREATE TABLE IF NOT EXISTS projects (
			projectId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			projectName VARCHAR(45) NOT NULL,
			projectStartDate DATE NOT NULL,
			projectEndDate DATE NOT NULL,
			projectJobType VARCHAR(50) NULL,
			projectConstructionType VARCHAR(50) NULL,
			projectSizeSqft INT UNSIGNED NULL,
			projectStreet VARCHAR(128) NULL,
			projectCity VARCHAR(50) NULL,
			projectState CHAR(2) NULL,
			projectZip VARCHAR(10) NULL,
			customerId INT UNSIGNED NOT NULL,
			PRIMARY KEY (projectId),
			FOREIGN KEY (customerId) REFERENCES customers (customerId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table projects has been created successfully<br>";
	}
	else {
		echo "Error creating the table projects: " . $db->error . "<br>";
	}


	//Create table ITBs
	$sql = "CREATE TABLE IF NOT EXISTS itbs (
			itbId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			itbDueDate DATE NOT NULL,
			itbSource VARCHAR(50) NULL,
			itbOnlineAccess VARCHAR(255) NULL,
			itbObservations TEXT NULL,
			projectId INT UNSIGNED NOT NULL UNIQUE,
			PRIMARY KEY (itbId),
			FOREIGN KEY (projectId) REFERENCES projects (projectId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table itbs has been created successfully<br>";
	}
	else {
		echo "Error creating the table itbs: " . $db->error . "<br>";
	}


	//Create table for bids
	$sql = "CREATE TABLE IF NOT EXISTS bids (
			bidId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			bidNumber INT UNSIGNED NOT NULL UNIQUE,
			bidExtendedDueDate DATE NULL,
			bidAmount DOUBLE(10,2) NOT NULL,
			bidStatus VARCHAR(30) NOT NULL,
			bidConfidence TINYINT(3) UNSIGNED NULL,
			bidMultipleGCs TINYINT(1) NULL,
			projectId INT UNSIGNED NOT NULL UNIQUE,
			PRIMARY KEY (bidId),
			FOREIGN KEY (projectId) REFERENCES projects (projectId)
			) ENGINE = InnoDB";


	if ($db->query($sql) === TRUE) {
		echo "Table bids has been created successfully<br>";
	}
	else {
		echo "Error creating the table bids: " . $db->error . "<br>";
	}


	//Create table for RFPs
	$sql = "CREATE TABLE IF NOT EXISTS rfps (
			rfpId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			rfpProductLine VARCHAR(30) NOT NULL,
			rfpDueDate DATE NOT NULL,
			rfpObservations TEXT NULL,
			rfpFile VARCHAR(255) NOT NULL,
			rfpDateCreated DATE NOT NULL,
			projectId INT UNSIGNED NOT NULL,
			PRIMARY KEY (rfpId),
			FOREIGN KEY (projectId) REFERENCES projects (`projectId`)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table rfps has been created successfully<br>";
	}
	else {
		echo "Error creating the table rfps: " . $db->error . "<br>";
	}


	//Create table to assign employees to projects
	$sql = "CREATE TABLE IF NOT EXISTS projects_employees (
			projects_employees_Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			projectId INT UNSIGNED NOT NULL,
			employeeId INT UNSIGNED NOT NULL,
			projects_employee_position VARCHAR(30) NOT NULL,
			PRIMARY KEY (projects_employees_Id),
			FOREIGN KEY (projectId) REFERENCES projects (projectId),
			FOREIGN KEY (employeeId) REFERENCES employees (employeeId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table projects_employees has been created successfully<br>";
	}
	else {
		echo "Error creating the table projects_employees: " . $db->error . "<br>";
	}


	//Create table project contacts
	$sql = "CREATE TABLE IF NOT EXISTS `unltdmgmt`.`projectContacts` (
			projectContactsId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			projectContactFirstName VARCHAR(50) NOT NULL,
			projectContactLastName VARCHAR(50) NULL,
			projectContactEmail VARCHAR(255) NULL,
			projectContactPhone VARCHAR(20) NULL,
			projectContactPhoneExt VARCHAR(10) NULL,
			projectContactMobile VARCHAR(20) NULL,
			projectId INT UNSIGNED NOT NULL,
			PRIMARY KEY (projectContactsId),
			FOREIGN KEY (projectId) REFERENCES projects (projectId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table projects has been created successfully<br>";
	}
	else {
		echo "Error creating the table projects: " . $db->error . "<br>";
	}


	//Create table for project budget
	$sql = "CREATE TABLE IF NOT EXISTS projectBudgetItems (
			projectBudgetItemId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			projectBudgetItemHours DOUBLE(7,2) UNSIGNED NULL,
			projectBudgetItemMaterialCost DOUBLE(10,2) NULL,
			projectId INT UNSIGNED NOT NULL,
			PRIMARY KEY (projectBudgetItemId),
			FOREIGN KEY (projectId) REFERENCES projects (projectId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table projectBudgetItems has been created successfully<br>";
	}
	else {
		echo "Error creating the table projectBudgetItems: " . $db->error . "<br>";
	}


	//Create a table to assign cost codes to the project budget items
	$sql = "CREATE TABLE IF NOT EXISTS projectBudget_costCodes (
			projectBudget_costCode_Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			projectBudgetId INT UNSIGNED NOT NULL,
			costCodeId INT UNSIGNED NOT NULL,
			PRIMARY KEY (projectBudget_costCode_Id),
			FOREIGN KEY (projectBudgetId) REFERENCES projectBudgetItems (`projectBudgetItemId`),
			FOREIGN KEY (costCodeId) REFERENCES costCodes (costCodesId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table projectBudget_costCodes has been created successfully<br>";
	}
	else {
		echo "Error creating the table projectBudget_costCodes: " . $db->error . "<br>";
	}


	//Create table for zones
	$sql = "CREATE TABLE IF NOT EXISTS zones (
			zoneId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			zoneNumber INT UNSIGNED NOT NULL,
			zoneName VARCHAR(50) NOT NULL,
			zoneStatus VARCHAR(30) NOT NULL DEFAULT 'Planning',
			projectId INT UNSIGNED NOT NULL,
			PRIMARY KEY (zoneId),
			FOREIGN KEY (projectId) REFERENCES projects (projectId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table zones has been created successfully<br>";
	}
	else {
		echo "Error creating the table zones: " . $db->error . "<br>";
	}


	//Create table zone bugdget
	$sql = "CREATE TABLE IF NOT EXISTS zoneBudgetItems (
			zoneBudgetItemId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			zoneBudgetItemHours DOUBLE(7,2) UNSIGNED NULL,
			zoneBudgetItemMaterialCost DOUBLE(10,2) UNSIGNED NULL,
			zoneId INT UNSIGNED NOT NULL,
			PRIMARY KEY (zoneBudgetItemId),
			FOREIGN KEY (zoneId) REFERENCES zones (zoneId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table zoneBudgetItems has been created successfully<br>";
	}
	else {
		echo "Error creating the table zoneBudgetItems: " . $db->error . "<br>";
	}


	//Create a table for material categories
	$sql = "CREATE TABLE IF NOT EXISTS materialCategories (
			materialCategoryId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			materialCategoryName VARCHAR(50) NOT NULL,
			PRIMARY KEY (materialCategoryId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table materialCategories has been created successfully<br>";
	}
	else {
		echo "Error creating the table materialCategories: " . $db->error . "<br>";
	}


	//Create a table for material subcategories
	$sql = "CREATE TABLE IF NOT EXISTS materialSubcategories (
			materialSubcategoryId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			materialSubcategoryName VARCHAR(50) NOT NULL,
			materialCategoryId INT UNSIGNED NOT NULL,
			PRIMARY KEY (materialSubcategoryId),
			FOREIGN KEY (materialCategoryId) REFERENCES materialCategories (materialCategoryId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table materialSubcategories has been created successfully<br>";
	}
	else {
		echo "Error creating the table materialSubcategories: " . $db->error . "<br>";
	}


	//Create a table for material item descriptions
	$sql = "CREATE TABLE IF NOT EXISTS materialDescriptions (
			materialDescriptionId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			materialDescriptionItem VARCHAR(50) NOT NULL,
			materialDescriptionUnit VARCHAR(15) NULL,
			materialSubcategoryId INT UNSIGNED NOT NULL,
			PRIMARY KEY (materialDescriptionId),
			FOREIGN KEY (materialSubcategoryId) REFERENCES materialSubcategories (materialSubcategoryId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table materialDescriptions has been created successfully<br>";
	}
	else {
		echo "Error creating the table materialDescriptions: " . $db->error . "<br>";
	}


	//Create a table for material orders
	$sql = "CREATE TABLE IF NOT EXISTS materialOrders (
			materialOrderId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			materialOrderArea VARCHAR(50) NOT NULL,
			materialOrderSentVendor TINYINT(1) NOT NULL DEFAULT 0,
			materialOrderSentPM TINYINT(1) NOT NULL DEFAULT 0,
			materialOrderDate DATE NOT NULL,
			materialOrderObservations TEXT NULL,
			projectId INT UNSIGNED NULL,
			eServiceRequestId INT UNSIGNED NULL,
			avServiceRequestId INT UNSIGNED NULL,
			PRIMARY KEY (materialOrderId),
			FOREIGN KEY (projectId) REFERENCES projects (projectId),
			FOREIGN KEY (eServiceRequestId) REFERENCES eServiceRequests (eServiceRequestId),
			FOREIGN KEY (avServiceRequestId) REFERENCES avServiceRequests (avServiceRequestId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table materialOrders has been created successfully<br>";
	}
	else {
		echo "Error creating the table materialOrders: " . $db->error . "<br>";
	}


	//Create a table to hold the material order vendors
	$sql = "CREATE TABLE IF NOT EXISTS materialOrders_vendors (
			materialOrders_vendors_Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			materialOrderId INT UNSIGNED NOT NULL,
			vendorId INT UNSIGNED NOT NULL,
			materialOrders_vendors_Award TINYINT(1) NOT NULL DEFAULT 0,
			PRIMARY KEY (materialOrders_vendors_Id),
			FOREIGN KEY (materialOrderId) REFERENCES materialOrders (materialOrderId),
			FOREIGN KEY (vendorId) REFERENCES vendors (vendorId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table materialOrders_vendors has been created successfully<br>";
	}
	else {
		echo "Error creating the table materialOrders_vendors: " . $db->error . "<br>";
	}


	//Create a table for material order items
	$sql = "CREATE TABLE IF NOT EXISTS materialOrderListItems (
			materialOrderListItemId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			materialOrderListItemQuantity INT UNSIGNED NOT NULL DEFAULT 0,
			materialOrderListItemDelivered INT UNSIGNED NOT NULL DEFAULT 0,
			materialOrderListItemComments VARCHAR(255) NULL,
			materialOrderId INT UNSIGNED NOT NULL,
			materialDescriptionId INT UNSIGNED NOT NULL,
			costCodeId INT UNSIGNED NOT NULL,
			zoneId INT UNSIGNED NULL,
			PRIMARY KEY (materialOrderListItemId),
			FOREIGN KEY (materialOrderId) REFERENCES materialOrders (materialOrderId),
			FOREIGN KEY (materialDescriptionId) REFERENCES materialDescriptions (materialDescriptionId),
			FOREIGN KEY (costCodeId) REFERENCES costCodes (costCodesId),
			FOREIGN KEY (zoneId) REFERENCES zones (zoneId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table materialOrderListItems has been created successfully<br>";
	}
	else {
		echo "Error creating the table materialOrderListItems: " . $db->error . "<br>";
	}


	// Create a table for material buyouts
	$sql = "CREATE TABLE IF NOT EXISTS materialBuyouts (
			materialBuyoutId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			materialBuyoutArea VARCHAR(50) NOT NULL,
			materialBuyoutSentVendor TINYINT(1) NOT NULL DEFAULT 0,
			materialBuyoutSentPM TINYINT(1) NOT NULL DEFAULT 0,
			materialBuyoutObservations TEXT NULL,
			projectId INT UNSIGNED NOT NULL,
			PRIMARY KEY (materialBuyoutId),
			FOREIGN KEY (projectId) REFERENCES projects (projectId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table materialBuyouts has been created successfully<br>";
	}
	else {
		echo "Error creating the table materialBuyouts: " . $db->error . "<br>";
	}


	//Create a table to assign vendors to the material buyout
	$sql = "CREATE TABLE IF NOT EXISTS materialBuyouts_vendors (
			materialBuyouts_vendors_Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			materialBuyoutId INT UNSIGNED NOT NULL,
			vendorId INT UNSIGNED NOT NULL,
			PRIMARY KEY (materialBuyouts_vendors_Id),
			FOREIGN KEY (materialBuyoutId) REFERENCES materialBuyouts (materialBuyoutId),
			FOREIGN KEY (vendorId) REFERENCES vendors (vendorId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table materialBuyouts_vendors has been created successfully<br>";
	}
	else {
		echo "Error creating the table materialBuyouts_vendors: " . $db->error . "<br>";
	}


	// Create a table to hold the material buyout items
	$sql = "CREATE TABLE IF NOT EXISTS materialBuyoutListItems (
			materialBuyoutListItemId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			materialBuyoutListItemQuantity INT UNSIGNED NOT NULL DEFAULT 0,
			materialBuyoutListItemDelivered INT UNSIGNED NOT NULL DEFAULT 0,
			materialBuyoutListItemComments VARCHAR(255) NULL,
			materialBuyoutId INT UNSIGNED NOT NULL,
			materialDescriptionId INT UNSIGNED NOT NULL,
			costCodeId INT UNSIGNED NOT NULL,
			zoneId INT UNSIGNED NULL,
			PRIMARY KEY (materialBuyoutListItemId),
			FOREIGN KEY (materialBuyoutId) REFERENCES materialBuyouts (materialBuyoutId),
			FOREIGN KEY (materialDescriptionId) REFERENCES materialDescriptions (materialDescriptionId),
			FOREIGN KEY (costCodeId) REFERENCES costCodes (costCodesId),
			FOREIGN KEY (zoneId) REFERENCES zones (zoneId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table materialBuyoutListItems has been created successfully<br>";
	}
	else {
		echo "Error creating the table materialBuyoutListItems: " . $db->error . "<br>";
	}


	// Create a table for the material buyout releases
	$sql = "CREATE TABLE IF NOT EXISTS materialBuyoutReleases (
			materialBuyoutReleaseId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			materialBuyoutReleaseNumber TINYINT UNSIGNED NOT NULL UNIQUE,
			materialBuyoutReleaseQuantity INT UNSIGNED NOT NULL,
			materialBuyoutReleaseDate DATE NULL,
			materialBuyoutReleaseBackOrder INT UNSIGNED NULL,
			materialBuyoutId INT UNSIGNED NOT NULL,
			materialBuyoutListItemId INT UNSIGNED NOT NULL,
			PRIMARY KEY (materialBuyoutReleaseId),
			FOREIGN KEY (materialBuyoutId) REFERENCES unltdmgmt.materialBuyouts (materialBuyoutId),
			FOREIGN KEY (materialBuyoutListItemId) REFERENCES unltdmgmt.materialBuyoutListItems (materialBuyoutListItemId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table materialBuyoutReleases has been created successfully<br>";
	}
	else {
		echo "Error creating the table materialBuyoutReleases: " . $db->error . "<br>";
	}


	// Create a table for lighting buyouts
	$sql = "CREATE TABLE IF NOT EXISTS lightingBuyouts (
			lightingBuyoutId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			lightingBuyoutDescription VARCHAR(50) NOT NULL,
			lightingBuyoutStatus VARCHAR(20) NULL,
			lightingBuyoutSentVendor TINYINT(1) NOT NULL DEFAULT 0,
			lightingBuyoutSentPM TINYINT(1) NOT NULL DEFAULT 0,
			lightingBuyoutObservations TEXT NULL,
			projectId INT UNSIGNED NOT NULL,
			PRIMARY KEY (lightingBuyoutId),
			FOREIGN KEY (projectId) REFERENCES projects (projectId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table lightingBuyouts has been created successfully<br>";
	}
	else {
		echo "Error creating the table lightingBuyouts: " . $db->error . "<br>";
	}


	// Create a table to assign vendors to the lighting buyouts
	$sql = "CREATE TABLE IF NOT EXISTS lightingBuyouts_vendors (
			lightingBuyouts_vendors_Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			lightingBuyoutId INT UNSIGNED NOT NULL,
			vendorId INT UNSIGNED NOT NULL,
			PRIMARY KEY (lightingBuyouts_vendors_Id),
			FOREIGN KEY (lightingBuyoutId) REFERENCES lightingBuyouts (lightingBuyoutId),
			FOREIGN KEY (vendorId) REFERENCES vendors (vendorId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table lightingBuyouts_vendors has been created successfully<br>";
	}
	else {
		echo "Error creating the table lightingBuyouts_vendors: " . $db->error . "<br>";
	}


	// Create a table for lighting fixtures
	$sql = "CREATE TABLE IF NOT EXISTS lightingFixtures (
			lightingFixtureId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			lightingFixtureQuantity INT UNSIGNED NOT NULL,
			lightingFixtureUnit VARCHAR(10) NULL,
			lightingFixtureType VARCHAR(50) NULL,
			lightingFixtureManufacturer VARCHAR(50) NULL,
			lightingFixtureDescription VARCHAR(128) NULL,
			lightingFixtureCatalogNumber VARCHAR(50) NULL,
			lightingFixtureAlternative TINYINT(1) NOT NULL DEFAULT 0,
			lightingFixtureNotes VARCHAR(255) NULL,
			lightingFixturePicture VARCHAR(255) NULL,
			lightingBuyoutId INT UNSIGNED NOT NULL,
			PRIMARY KEY (lightingFixtureId),
			FOREIGN KEY (lightingBuyoutId) REFERENCES unltdmgmt.lightingBuyouts (lightingBuyoutId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table lightingFixtures has been created successfully<br>";
	}
	else {
		echo "Error creating the table lightingFixtures: " . $db->error . "<br>";
	}


	// Create a table for lighting fixture parts
	$sql = "CREATE TABLE IF NOT EXISTS lightingFixtureParts (
			lightingFixturePartId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			lightingFixturePartCategory VARCHAR(15) NOT NULL,
			lightingFixturePartType VARCHAR(20) NULL,
			lightingFixturePartQuantity INT UNSIGNED NOT NULL,
			lightingFixtureId INT UNSIGNED NOT NULL,
			PRIMARY KEY (lightingFixturePartId),
			FOREIGN KEY (lightingFixtureId) REFERENCES lightingFixtures (lightingFixtureId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table lightingFixtureParts has been created successfully<br>";
	}
	else {
		echo "Error creating the table lightingFixtureParts: " . $db->error . "<br>";
	}


	// Create a table for lighting releases
	$sql = "CREATE TABLE IF NOT EXISTS lightingReleases (
			lightingReleaseId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			lightingReleaseNumber INT UNSIGNED NOT NULL,
			lightingReleaseWholeFixture INT UNSIGNED NULL,
			lightingFixtureId INT UNSIGNED NOT NULL,
			lightingFixturePartId INT UNSIGNED NULL,
			PRIMARY KEY (lightingReleaseId),
			FOREIGN KEY (lightingFixtureId) REFERENCES lightingFixtures (lightingFixtureId),
			FOREIGN KEY (lightingFixturePartId) REFERENCES lightingFixtureParts (lightingFixturePartId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table lightingReleases has been created successfully<br>";
	}
	else {
		echo "Error creating the table lightingReleases: " . $db->error . "<br>";
	}


	//Create a table for quotes
	$sql = "CREATE TABLE IF NOT EXISTS quotes (
			quoteId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			quotePO INT UNSIGNED NULL,
			quoteObservations TEXT NULL,
			quoteDecision CHAR(1) NOT NULL DEFAULT 'N',
			quoteAmount INT NULL,
			quoteFile VARCHAR(255) NULL,
			rfpId INT UNSIGNED NOT NULL,
			materialOrders_vendors_Id INT UNSIGNED NULL,
			materialBuyouts_vendors_Id INT UNSIGNED NULL,
			lightingBuyouts_vendors_Id INT UNSIGNED NULL,
			PRIMARY KEY (quoteId),
			FOREIGN KEY (rfpId) REFERENCES unltdmgmt.rfps (rfpId),
			FOREIGN KEY (materialBuyouts_vendors_Id) REFERENCES materialBuyouts_vendors (materialBuyouts_vendors_Id),
			FOREIGN KEY (materialOrders_vendors_Id) REFERENCES materialOrders_vendors (materialOrders_vendors_Id),
			FOREIGN KEY (lightingBuyouts_vendors_Id) REFERENCES lightingBuyouts_vendors (lightingBuyouts_vendors_Id)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table quotes has been created successfully<br>";
	}
	else {
		echo "Error creating the table quotes: " . $db->error . "<br>";
	}


	// Create a table for packing slips
	$sql = "CREATE TABLE IF NOT EXISTS packingSlips (
			packingSlipsId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			packingSlipFile VARCHAR(255) NOT NULL,
			packingSlipReviewed TINYINT(1) NOT NULL DEFAULT 0,
			materialOrderId INT UNSIGNED NULL,
			materialBuyoutReleaseId INT UNSIGNED NULL,
			lightingReleaseId INT UNSIGNED NULL,
			PRIMARY KEY (packingSlipsId),
			FOREIGN KEY (materialOrderId) REFERENCES materialOrders (materialOrderId),
			FOREIGN KEY (materialBuyoutReleaseId) REFERENCES materialBuyoutReleases (materialBuyoutReleaseId),
			FOREIGN KEY (lightingReleaseId) REFERENCES lightingReleases (lightingReleaseId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table packingSlips has been created successfully<br>";
	}
	else {
		echo "Error creating the table packingSlips: " . $db->error . "<br>";
	}


	// Create a table for file attachments
	$sql = "CREATE TABLE IF NOT EXISTS fileAttachments (
			fileAttachmentId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			fileAttachmentName VARCHAR(50) NULL,
			fileAttachmentFile VARCHAR(225) NOT NULL,
			materialOrderId INT UNSIGNED NULL,
			materialBuyoutId INT UNSIGNED NULL,
			dailyReportId INT UNSIGNED NULL,
			PRIMARY KEY (fileAttachmentId),
			FOREIGN KEY (materialOrderId) REFERENCES materialOrders (materialOrderId),
			FOREIGN KEY (materialBuyoutId) REFERENCES materialBuyouts (materialBuyoutId),
			FOREIGN KEY (dailyReportId) REFERENCES dailyReports (dailyReportId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table fileAttachments has been created successfully<br>";
	}
	else {
		echo "Error creating the table fileAttachments: " . $db->error . "<br>";
	}


	//Create a table for time sheets
	$sql = "CREATE TABLE IF NOT EXISTS timeSheets (
			timeSheetsId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			timeSheetLunchHours TIME NOT NULL DEFAULT '00:30:00',
			timeSheetRealStartTime TIMESTAMP NOT NULL,
			timeSheetStartTime TIME NOT NULL,
			timeSheetRealEndTime TIMESTAMP NOT NULL,
			timeSheetEndTime TIME NOT NULL,
			timeSheetClockinPic VARCHAR(255) NULL,
			timeSheetClockoutPic VARCHAR(255) NULL,
			projectId INT UNSIGNED NOT NULL,
			employeeId INT UNSIGNED NOT NULL,
			dailyReportId INT UNSIGNED NOT NULL,
			PRIMARY KEY (timeSheetsId),
			FOREIGN KEY (projectId) REFERENCES projects (projectId),
			FOREIGN KEY (employeeId) REFERENCES employees (employeeId),
			FOREIGN KEY (dailyReportId) REFERENCES dailyReports (dailyReportId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table timeSheets has been created successfully<br>";
	}
	else {
		echo "Error creating the table timeSheets: " . $db->error . "<br>";
	}


	//Create a table to assign cost codes and zones to the time sheets
	$sql = "CREATE TABLE IF NOT EXISTS timeSheets_costCodes_zones (
			timeSheets_costCode_zones_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			timeSheetId INT UNSIGNED NOT NULL,
			costCodeId INT UNSIGNED NOT NULL,
			zoneId INT UNSIGNED NULL,
			timeSheetHoursWorked TIME NOT NULL,
			PRIMARY KEY (timeSheets_costCode_zones_id),
			FOREIGN KEY (timeSheetId) REFERENCES timeSheets (timeSheetsId),
			FOREIGN KEY (costCodeId) REFERENCES costCodes (costCodesId),
			FOREIGN KEY (zoneId) REFERENCES zones (zoneId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table timeSheets_costCodes_zones has been created successfully<br>";
	}
	else {
		echo "Error creating the table timeSheets_costCodes_zones: " . $db->error . "<br>";
	}


	// Create a table for daily reports
	$sql = "CREATE TABLE IF NOT EXISTS dailyReports (
			dailyReportId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			dailyReportDate DATE NOT NULL,
			dailyReportUecWorkers TINYINT NULL,
			dailyReportPieceWorkers TINYINT NULL,
			dailyReportSuperintComments TEXT NULL,
			dailyReportManPowerSent TINYINT(1) NULL,
			dailyReportRentalEquipment VARCHAR(255) NULL,
			dailyReportTempLabor VARCHAR(255) NULL,
			dailyReportSubcontractors VARCHAR(255) NULL,
			dailyReportWeather VARCHAR(255) NULL,
			dailyReportBackOrders VARCHAR(255) NULL,
			dailyReportActivities TEXT NULL,
			dailyReportDelays VARCHAR(255) NULL,
			dailyReportExtraWork VARCHAR(255) NULL,
			projectId INT UNSIGNED NOT NULL,
			PRIMARY KEY (dailyReportId),
			FOREIGN KEY (projectId) REFERENCES projects (projectId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table dailyReports has been created successfully<br>";
	}
	else {
		echo "Error creating the table dailyReports: " . $db->error . "<br>";
	}


	//Create a table for Electric Service Jobs
	$sql = "CREATE TABLE IF NOT EXISTS eServiceJobs (
			eServiceJobId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			eServiceJobNumber VARCHAR(10) NOT NULL UNIQUE,
			eServiceJobType CHAR(1) NOT NULL,
			eServiceJobSiteType VARCHAR(20) NOT NULL,
			eServiceJobStreet VARCHAR(128) NOT NULL,
			eServiceJobCity VARCHAR(50) NOT NULL,
			eServiceJobState CHAR(2) NOT NULL,
			eServiceJobZip VARCHAR(10) NOT NULL,
			customerId INT UNSIGNED NOT NULL,
			mainCustomerRepId INT UNSIGNED NULL,
			PRIMARY KEY (eServiceJobId),
			FOREIGN KEY (customerId) REFERENCES customers (customerId),
			FOREIGN KEY (mainCustomerRepId) REFERENCES customerReps (customerRepId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table eServiceJobs has been created successfully<br>";
	}
	else {
		echo "Error creating the table eServiceJobs: " . $db->error . "<br>";
	}


	//Create a table for electric service requests
	$sql = "CREATE TABLE IF NOT EXISTS eServiceRequests (
			eServiceRequestId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			eServiceRequestType CHAR(1) NOT NULL,
			eServiceRequestCustWO VARCHAR(50) NULL,
			eServiceRequestUECWO VARCHAR(50) NULL,
			eServiceRequestScope TEXT NULL,
			eServiceRequestStatus VARCHAR(10) NULL,
			eServiceRequestObservations VARCHAR(255) NULL,
			eServiceRequestBilling VARCHAR(15) NULL,
			eServiceRequestDepositRequest DATE NULL,
			eServiceRequestDepositReceived DATE NULL,
			eServiceRequestCODRequest DATE NULL,
			eServiceRequestCODReceived DATE NULL,
			eServiceRequestProposal TINYINT(1) NULL,
			eServiceJobId INT UNSIGNED NOT NULL,
			PRIMARY KEY (eServiceRequestId),
			FOREIGN KEY (eServiceJobId) REFERENCES eServiceJobs (eServiceJobId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table eServiceRequests has been created successfully<br>";
	}
	else {
		echo "Error creating the table eServiceRequests: " . $db->error . "<br>";
	}


	//Create a table for electrical service dispatches
	$sql = "CREATE TABLE IF NOT EXISTS eServiceDispatches (
			eServiceDispatchId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			eServiceDispatchDate DATE NOT NULL,
			eServiceDispatchTime TIME NOT NULL,
			eServiceDispatchObservations VARCHAR(255) NULL,
			eServiceDispatchClockin DATETIME NULL,
			eServiceDispatchClockout DATETIME NULL,
			eServiceDispatchClockinLatitude DOUBLE NULL,
			eServiceDispatchClockinLongitude DOUBLE NULL,
			eServiceDispatchClockoutLatitude DOUBLE NULL,
			eServiceDispatchClockoutLongitude DOUBLE NULL,
			eServiceDispatchEndDay TINYINT(1) NOT NULL DEFAULT 0,
			eServiceDispatchParts TINYINT(1) NOT NULL DEFAULT 0,
			eServiceRequestId INT UNSIGNED NOT NULL,
			PRIMARY KEY (eServiceDispatchId),
			FOREIGN KEY (eServiceRequestId) REFERENCES eServiceRequests (eServiceRequestId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table eServiceDispatches has been created successfully<br>";
	}
	else {
		echo "Error creating the table eServiceDispatches: " . $db->error . "<br>";
	}


	//Create a table for electical service invoices
	$sql = "CREATE TABLE IF NOT EXISTS eServiceInvoices (
			eServiceInvoiceId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			eServiceInvoicePartial TINYINT(1) NULL,
			eServiceInvoiceDate DATE NULL,
			eServiceInvoiceTerms DATE NULL,
			eServiceInvoiceCustEmail TINYINT(1) NULL,
			eServiceInvoicePaymentReceived TINYINT(1) NULL,
			eServiceRequestId INT UNSIGNED NOT NULL,
			PRIMARY KEY (eServiceInvoiceId),
			FOREIGN KEY (eServiceRequestId) REFERENCES unltdmgmt.eServiceRequests (eServiceRequestId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table avServiceDispatches has been created successfully<br>";
	}
	else {
		echo "Error creating the table avServiceDispatches: " . $db->error . "<br>";
	}


		// Create a table for av service jobs
	$sql = "CREATE TABLE IF NOT EXISTS avServiceJobs (
			avServiceJobId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			avServiceJobNumber VARCHAR(10) NOT NULL UNIQUE,
			avServiceJobType CHAR(1) NOT NULL,
			avServiceJobSiteType VARCHAR(20) NOT NULL,
			avServiceJobStreet VARCHAR(128) NOT NULL,
			avServiceJobCity VARCHAR(50) NOT NULL,
			avServiceJobState CHAR(2) NOT NULL,
			avServiceJobZip VARCHAR(10) NOT NULL,
			customerId INT UNSIGNED NOT NULL,
			mainCustomerRepId INT UNSIGNED NULL,
			PRIMARY KEY (avServiceJobId),
			FOREIGN KEY (customerId) REFERENCES customers (customerId),
			FOREIGN KEY (mainCustomerRepId) REFERENCES customerReps (customerRepId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table avServiceJobs has been created successfully<br>";
	}
	else {
		echo "Error creating the table avServiceJobs: " . $db->error . "<br>";
	}


	//Create a table for av service requests
	$sql = "CREATE TABLE IF NOT EXISTS avServiceRequests (
			avServiceRequestId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			avServiceRequestType CHAR(1) NOT NULL,
			avServiceRequestCustWO VARCHAR(50) NULL,
			avServiceRequestUECWO VARCHAR(50) NULL,
			avServiceRequestScope TEXT NULL,
			avServiceRequestStatus VARCHAR(10) NULL,
			avServiceRequestObservations VARCHAR(255) NULL,
			avServiceRequestBilling VARCHAR(15) NULL,
			avServiceRequestDepositRequest DATE NULL,
			avServiceRequestDepositReceived DATE NULL,
			avServiceRequestCODRequest DATE NULL,
			avServiceRequestCODReceived DATE NULL,
			avServiceRequestProposal TINYINT(1) NULL,
			avServiceJobId INT UNSIGNED NOT NULL,
			PRIMARY KEY (avServiceRequestId),
			FOREIGN KEY (avServiceJobId) REFERENCES avServiceJobs (avServiceJobId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table avServiceRequests has been created successfully<br>";
	}
	else {
		echo "Error creating the table avServiceRequests: " . $db->error . "<br>";
	}


	//Create a table for av service dispatches
	$sql = "CREATE TABLE IF NOT EXISTS avServiceDispatches (
			avServiceDispatchId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			avServiceDispatchDate DATE NOT NULL,
			avServiceDispatchTime TIME NOT NULL,
			avServiceDispatchObservations VARCHAR(255) NULL,
			avServiceDispatchClockin DATETIME NULL,
			avServiceDispatchClockout DATETIME NULL,
			avServiceDispatchClockinLatitude DOUBLE NULL,
			avServiceDispatchClockinLongitude DOUBLE NULL,
			avServiceDispatchClockoutLatitude DOUBLE NULL,
			avServiceDispatchClockoutLongitude DOUBLE NULL,
			avServiceDispatchEndDay TINYINT(1) NOT NULL DEFAULT 0,
			avServiceDispatchParts TINYINT(1) NOT NULL DEFAULT 0,
			avServiceRequestId INT UNSIGNED NOT NULL,
			PRIMARY KEY (avServiceDispatchId),
			FOREIGN KEY (avServiceRequestId) REFERENCES avServiceRequests (avServiceRequestId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table avServiceDispatches has been created successfully<br>";
	}
	else {
		echo "Error creating the table avServiceDispatches: " . $db->error . "<br>";
	}


	//Create a table for av service invoices
	$sql = "CREATE TABLE IF NOT EXISTS avServiceInvoices (
			avServiceInvoiceId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			avServiceInvoicePartial TINYINT(1) NULL,
			avServiceInvoiceDate DATE NULL,
			avServiceInvoiceTerms DATE NULL,
			avServiceInvoiceCustEmail TINYINT(1) NULL,
			avServiceInvoicePaymentReceived TINYINT(1) NULL,
			avServiceRequestId INT UNSIGNED NOT NULL,
			PRIMARY KEY (avServiceInvoiceId),
			FOREIGN KEY (avServiceRequestId) REFERENCES avServiceRequests (avServiceRequestId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table avServiceInvoices has been created successfully<br>";
	}
	else {
		echo "Error creating the table avServiceInvoices: " . $db->error . "<br>";
	}


	//Create a table for job applications
	$sql = "CREATE TABLE IF NOT EXISTS jobApplications (
			jobApplicationId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			jobApplicationDate DATE NOT NULL,
			jobApplicationSignature VARCHAR(50) NOT NULL,
			jobApplicationSignatureDate DATE NULL,
			jobApplicationW4 BLOB NULL,
			jobApplicationI9 BLOB NULL,
			PRIMARY KEY (jobApplicationId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table jobApplications has been created successfully<br>";
	}
	else {
		echo "Error creating the table jobApplications: " . $db->error . "<br>";
	}


	//Create a table for applicant info
	$sql = "CREATE TABLE IF NOT EXISTS applicantInfo (
			applicantInfoId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			applicantInfoFirstName VARCHAR(50) NOT NULL,
			applicantInfoLastName VARCHAR(50) NOT NULL,
			applicantInfoMiddleName VARCHAR(50) NULL,
			applicantInfoPhone VARCHAR(20) NULL,
			applicantInfoEmail VARCHAR(255) NULL,
			applicantInfoSocialSecurity VARCHAR(20) NULL,
			applicantInfoStreet VARCHAR(128) NULL,
			applicantInfoCity VARCHAR(50) NULL,
			applicantInfoState CHAR(2) NULL,
			applicantInfoZip VARCHAR(10) NULL,
			jobApplicationId INT UNSIGNED NOT NULL UNIQUE,
			PRIMARY KEY (applicantInfoId),
			FOREIGN KEY (jobApplicationId) REFERENCES jobApplications (jobApplicationId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table applicantInfo has been created successfully<br>";
	}
	else {
		echo "Error creating the table applicantInfo: " . $db->error . "<br>";
	}


	//Create a table for application information
	$sql = "CREATE TABLE IF NOT EXISTS applicationInfo (
			applicationInfoId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			applicationInfoPosition VARCHAR(30) NULL,
			applicationInfoSource VARCHAR(30) NULL,
			applicationInfoDateAvail DATE NULL,
			applicationInfoRequiredSalary DOUBLE(10, 2) NULL,
			applicationInfoInterests TEXT NULL,
			applicationInfoConvicted TINYINT(1) NULL,
			applicationInfoConvictedExplain VARCHAR(255) NULL,
			applicationInfoCitizen TINYINT(1) NULL,
			applicationInfoWorkAuthorized TINYINT(1) NULL,
			jobApplicationId INT UNSIGNED NOT NULL UNIQUE,
			PRIMARY KEY (applicationInfoId),
			FOREIGN KEY (jobApplicationId) REFERENCES jobApplications (jobApplicationId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table applicationInfo has been created successfully<br>";
	}
	else {
		echo "Error creating the table applicationInfo: " . $db->error . "<br>";
	}


	//Create a table for employment history
	$sql = "CREATE TABLE IF NOT EXISTS employmentHistory (
			employmentHistoryId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			employmentHistoryCompany VARCHAR(128) NULL,
			employmentHistoryAddress VARCHAR(255) NULL,
			employmentHistoryPhone VARCHAR(20) NULL,
			employmentHistorySupervisor VARCHAR(50) NULL,
			employmentHistoryFrom DATE NULL,
			employmentHistoryTo DATE NULL,
			employmentHistoryStartingSalary DOUBLE(10, 2) NULL,
			employmentHistoryEndingSalary DOUBLE(10, 2) NULL,
			employmentHistoryDuties VARCHAR(255) NULL,
			employmentHistoryLeavingReason VARCHAR(255) NULL,
			employmentHistoryChangeReason VARCHAR(255) NULL,
			employmentHistoryCallEmployer TINYINT(1) NULL,
			jobApplicationId INT UNSIGNED NOT NULL,
			PRIMARY KEY (employmentHistoryId),
			FOREIGN KEY (jobApplicationId) REFERENCES jobApplications (jobApplicationId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table employmentHistory has been created successfully<br>";
	}
	else {
		echo "Error creating the table employmentHistory: " . $db->error . "<br>";
	}


	//Create a table for application references
	$sql = "CREATE TABLE IF NOT EXISTS jobApplicationReferences (
			jobApplicationReferenceId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			jobApplicationReferenceName VARCHAR(128) NULL,
			jobApplicationReferenceAddress VARCHAR(255) NULL,
			jobApplicationReferencePhone VARCHAR(20) NULL,
			jobApplicationReferenceRelationship VARCHAR(50) NULL,
			jobApplicationId INT UNSIGNED NOT NULL,
			PRIMARY KEY (jobApplicationReferenceId),
			FOREIGN KEY (jobApplicationId) REFERENCES jobApplications (jobApplicationId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table jobApplicationReferences has been created successfully<br>";
	}
	else {
		echo "Error creating the table jobApplicationReferences: " . $db->error . "<br>";
	}


	//Create a table for application education history
	$sql = "CREATE TABLE IF NOT EXISTS educationHistory (
			educationHistoryId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			educationHistoryInstitution VARCHAR(50) NULL,
			educationHistoryCourse VARCHAR(50) NULL,
			educationHistoryYearsCompleted TINYINT UNSIGNED NULL,
			educationHistoryGraduated TINYINT(1) NULL,
			educationHistoryDegree VARCHAR(50) NULL,
			educationHistoryNotGrad VARCHAR(255) NULL,
			educationHistoryFutureStudy TINYINT(1) NULL,
			jobApplicationId INT UNSIGNED NOT NULL,
			PRIMARY KEY (educationHistoryId),
			FOREIGN KEY (jobApplicationId) REFERENCES jobApplications (jobApplicationId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table educationHistory has been created successfully<br>";
	}
	else {
		echo "Error creating the table educationHistory: " . $db->error . "<br>";
	}


	//Create a table for job agreements
	$sql = "CREATE TABLE IF NOT EXISTS jobAgreements (
			jobAgreementId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			jobAgreementSignature VARCHAR(50) NULL,
			jobAgreementSignDate DATE NULL,
			jobAgreementHandbookSign VARCHAR(50) NULL,
			jobAgreementHandbSignDate DATE NULL,
			jobApplicationId INT UNSIGNED NOT NULL UNIQUE,
			PRIMARY KEY (jobAgreementId),
			FOREIGN KEY (jobApplicationId) REFERENCES unltdmgmt.jobApplications (jobApplicationId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table jobAgreements has been created successfully<br>";
	}
	else {
		echo "Error creating the table jobAgreements: " . $db->error . "<br>";
	}


	//Create a table for test questions
	$sql = "CREATE TABLE IF NOT EXISTS testQuestions (
			testQuestionId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			testQuestionQuestion VARCHAR(255) NOT NULL,
			testQuestionAnswerA VARCHAR(255) NOT NULL,
			testQuestionAnswerB VARCHAR(255) NOT NULL,
			testQuestionAnswerC VARCHAR(255) NOT NULL,
			testQuestionAnswerD VARCHAR(255) NOT NULL,
			testQuestionCorrect CHAR(1) NOT NULL,
			testQuestionType VARCHAR(10) NOT NULL,
			PRIMARY KEY (testQuestionId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table testQuestions has been created successfully<br>";
	}
	else {
		echo "Error creating the table testQuestions: " . $db->error . "<br>";
	}


	//Create table for employee tests
	$sql = "CREATE TABLE IF NOT EXISTS employeeTests (
			employeeTestId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			employeeTestTry TINYINT UNSIGNED NOT NULL,
			employeeTestDate DATE NOT NULL,
			employeeTestQuestion TINYINT UNSIGNED NOT NULL,
			employeeTestAnswer CHAR(1) NULL,
			jobApplicationId INT UNSIGNED NULL,
			testQuestionId INT UNSIGNED NOT NULL,
			employeeId INT UNSIGNED NULL,
			PRIMARY KEY (employeeTestId),
			FOREIGN KEY (jobApplicationId) REFERENCES jobApplications (jobApplicationId),
			FOREIGN KEY (testQuestionId) REFERENCES testQuestions (testQuestionId),
			FOREIGN KEY (employeeId) REFERENCES employees (employeeId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table employeeTests has been created successfully<br>";
	}
	else {
		echo "Error creating the table employeeTests: " . $db->error . "<br>";
	}


	//Create table for health centers
	$sql = "CREATE TABLE IF NOT EXISTS healthCenters (
			healthCenterId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			healthCenterName VARCHAR(128) NULL,
			healthCenterStreet VARCHAR(128) NULL,
			healthCenterCity VARCHAR(50) NULL,
			healthCenterState CHAR(2) NULL,
			healthCenterZip VARCHAR(10) NULL,
			healthCenterPhone VARCHAR(20) NULL,
			healthCenterHours VARCHAR(255) NULL,
			PRIMARY KEY (healthCenterId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table healthCenters has been created successfully<br>";
	}
	else {
		echo "Error creating the table healthCenters: " . $db->error . "<br>";
	}


	//Create a table for vehicles
	$sql = "CREATE TABLE IF NOT EXISTS vehicles (
			vehicleId INT UNSIGNED NOT NULL AUTO_INCREMENT,
			vehicleMake VARCHAR(30) NOT NULL,
			vehicleModel VARCHAR(30) NOT NULL,
			vehicleVinNumber VARCHAR(20) NOT NULL,
			vehicleLicencePlate VARCHAR(15) NULL,
			vehicleLastService DATE NULL,
			vehicleOdometer MEDIUMINT UNSIGNED NULL,
			vehicleNextService DATE NULL,
			employeeId INT UNSIGNED NULL,
			PRIMARY KEY (vehicleId),
			FOREIGN KEY (employeeId) REFERENCES employees (employeeId)
			) ENGINE = InnoDB";

	if ($db->query($sql) === TRUE) {
		echo "Table vehicles has been created successfully<br>";
	}
	else {
		echo "Error creating the table vehicles: " . $db->error . "<br>";
	}
?>