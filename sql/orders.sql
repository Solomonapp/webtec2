CREATE TABLE orders (
	orderNumber int(11) AUTO_INCREMENT,
    customerName text NOT NULL,
    customerPhone text NOT NULL,
    customerEmail text NOT NULL,
    ordereditem text NOT NULL,
    itemPrice text NOT NULL,
    PRIMARY KEY(orderNumber)
);