INSERT INTO User
VALUES ('kentfr01', 'Francis', 'Kent', '2003-07-23', 'kentfr01');

INSERT INTO User
VALUES ('brooro01', 'Robert', 'Brooks', '2001-04-07', 'brooro01');

INSERT INTO User
VALUES ('mossma01', 'Martha', 'Moss', '2002-11-12', 'mossma01');

INSERT INTO User
VALUES ('stanro01', 'Rodney', 'Stanley', '2001-09-01', 'stanro01');

INSERT INTO User
VALUES ('jamebo01', 'Bobby', 'James', '2004-01-16', 'jamebo01');

INSERT INTO User
VALUES ('sullgr01', 'Grace', 'Sullivan', '2003-12-06', 'sullgr01');

INSERT INTO User
VALUES ('wallca01', 'Carl', 'Wallace', '2002-07-20', 'wallca01');

INSERT INTO User
VALUES ('maloma01', 'Matt', 'Malone', '2003-10-10', 'maloma01');

INSERT INTO User
VALUES ('myerca01', 'Caitlyn', 'Myers', '2002-02-26', 'myerca01');

INSERT INTO User
VALUES ('shieka01', 'Kate', 'Shields', '2003-09-09', 'shieka01');

INSERT INTO User
VALUES ('barbch01', 'Chris', 'Barber', '2001-11-14', 'barbch01');

INSERT INTO User
VALUES ('russro01', 'Rory', 'Russell', '2002-01-06', 'russro01');

INSERT INTO User
VALUES ('wallca01', 'Alex', 'Wiggins', '2002-04-19', 'wallca01');

INSERT INTO User
VALUES ('gilmow01', 'Owen', 'Gilman', '2002-01-01', 'gilmow01');

INSERT INTO User
VALUES ('cummbe01', 'Benedict', 'Cummings', '2002-01-02', 'cummbe01');

INSERT INTO User
VALUES ('tangyi02', 'Barry', 'Tang', '2002-01-03', 'tangyi02');

INSERT INTO End_User
VALUES ('kentfr01','2381 Desert Broom Court');

INSERT INTO End_User
VALUES ('brooro01','624 Capitol Avenue');

INSERT INTO End_User
VALUES ('mossma01','984 Michigan Avenue');

INSERT INTO End_User
VALUES ('stanro01','4174 Godfrey Road');

INSERT INTO End_User
VALUES ('sullgr01','1767 Spruce Drive');

INSERT INTO End_User
VALUES ('wallca01','2517 2770 Calico Drive');

INSERT INTO End_User
VALUES ('maloma01','4692 Railroad Street');

INSERT INTO End_User
VALUES ('myerca01','1194 Coburn Hollow Road');

INSERT INTO Admin
VALUES ('shieka01');

INSERT INTO Admin
VALUES ('barbch01');

INSERT INTO Admin
VALUES ('russro01');

INSERT INTO Admin
VALUES ('wallca01');

INSERT INTO Admin
VALUES ('maloma01');

INSERT INTO Admin
VALUES ('gilmow01');

INSERT INTO Admin
VALUES ('cummbe01');

INSERT INTO Admin
VALUES ('tangyi02');

INSERT INTO Buyer
VALUES ('kentfr01', 10);

INSERT INTO Buyer
VALUES ('brooro01',15);

INSERT INTO Buyer
VALUES ('mossma01',8);

INSERT INTO Buyer
VALUES ('stanro01',97);

INSERT INTO Buyer
VALUES ('sullgr01',311);

INSERT INTO Buyer
VALUES ('wallca01',1);

INSERT INTO Buyer
VALUES ('maloma01',14);

INSERT INTO Buyer
VALUES ('myerca01',87);

INSERT INTO Seller
VALUES ('kentfr01', 87);

INSERT INTO Seller
VALUES ('brooro01',10);

INSERT INTO Seller
VALUES ('mossma01',15);

INSERT INTO Seller
VALUES ('stanro01',8);

INSERT INTO Seller
VALUES ('sullgr01',97);

INSERT INTO Seller
VALUES ('wallca01',311);

INSERT INTO Seller
VALUES ('maloma01',1);

INSERT INTO Seller
VALUES ('myerca01',14);

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('Fundamentals of Physics Textbook', 'Very good', 1, 'Course Materials', NOW(), 'https://m.media-amazon.com/images/I/81+lwBghWBL._AC_UF1000,1000_QL80_.jpg', 'Very good condition Physics textbook for Physics 111', 'kentfr01', 29.99)

INSERT INTO ITEM (item_title, item_condition, item_size, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('Large Gettysburg T-Shirt', 'Good', 'Large', 1, 'Fashion', NOW(), 'https://images.footballfanatics.com/gettysburg-bullets/gettysburg-college-champion-jersey-short-sleeve-t-shirt-navy_ss10_p-100797648+u-tvvzialj6ngp73mi6qel+v-3ha6ijmm8mcg7ipnk28s.jpg?_hv=2&w=600', 'Good condition Large Gettysburg t-shirt', 'brooro01', 19.99)

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('TI-84 Calculator', 'Used', 1, 'Technology', NOW(), 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkIfHuv6AIK3y_XwGAorVYyDlq39GhGf55EL90vQ7d4wUDW6BNblqk2iM9FMp0j9OXNn0&usqp=CAU', 'Used but working TI-84 calculator', 'mossma01', 55.99)

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('ReMarkable', 'Very Good', 1, 'Technology', NOW(), 'https://m.media-amazon.com/images/I/71OL7PXfOeL.jpg', 'Good condition ReMarkable tablet', 'stanro01', 79.99)

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('', 'Very Good', 1, 'Technology', NOW(), 'https://m.media-amazon.com/images/I/71OL7PXfOeL.jpg', 'Used but working TI-84 calculator', 'stanro01', 99.99)



