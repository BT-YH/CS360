INSERT INTO USER
VALUES ('kentfr01', 'Francis', 'Kent', '2003-07-23', 'kentfr01');

INSERT INTO USER
VALUES ('brooro01', 'Robert', 'Brooks', '2001-04-07', 'brooro01');

INSERT INTO USER
VALUES ('mossma01', 'Martha', 'Moss', '2002-11-12', 'mossma01');

INSERT INTO USER
VALUES ('stanro01', 'Rodney', 'Stanley', '2001-09-01', 'stanro01');

INSERT INTO USER
VALUES ('jamebo01', 'Bobby', 'James', '2004-01-16', 'jamebo01');

INSERT INTO USER
VALUES ('sullgr01', 'Grace', 'Sullivan', '2003-12-06', 'sullgr01');

INSERT INTO USER
VALUES ('wallca01', 'Carl', 'Wallace', '2002-07-20', 'wallca01');

INSERT INTO USER
VALUES ('maloma01', 'Matt', 'Malone', '2003-10-10', 'maloma01');

INSERT INTO USER
VALUES ('myervi01', 'Victoria', 'Myers', '2002-02-26', 'myervi01');

INSERT INTO USER
VALUES ('shieka01', 'Kate', 'Shields', '2003-09-09', 'shieka01');

INSERT INTO USER
VALUES ('barbch01', 'Chris', 'Barber', '2001-11-14', 'barbch01');

INSERT INTO USER
VALUES ('russro01', 'Rory', 'Russell', '2002-01-06', 'russro01');

INSERT INTO USER
VALUES ('wallca01', 'Alex', 'Wiggins', '2002-04-19', 'wallca01');

INSERT INTO USER
VALUES ('gilmow01', 'Owen', 'Gilman', '2002-01-01', 'gilmow01');

INSERT INTO USER
VALUES ('cummbe01', 'Benedict', 'Cummings', '2002-01-02', 'cummbe01');

INSERT INTO USER
VALUES ('tangyi02', 'Barry', 'Tang', '2002-01-03', 'tangyi02');

INSERT INTO USER
VALUES ('smitke03', 'Kevin', 'Smith', '2002-01-04', 'smitke03');

INSERT INTO END_USER
VALUES ('kentfr01','2381 Desert Broom Court');

INSERT INTO END_USER
VALUES ('brooro01','624 Capitol Avenue');

INSERT INTO END_USER
VALUES ('mossma01','984 Michigan Avenue');

INSERT INTO END_USER
VALUES ('stanro01','4174 Godfrey Road');

INSERT INTO END_USER
VALUES ('sullgr01','1767 Spruce Drive');

INSERT INTO END_USER
VALUES ('wallca01','2517 2770 Calico Drive');

INSERT INTO END_USER
VALUES ('maloma01','4692 Railroad Street');

INSERT INTO END_USER
VALUES ('myervi01','1194 Coburn Hollow Road');

INSERT INTO END_USER
VALUES ('smitke03','1234 Main Street');

INSERT INTO ADMIN
VALUES ('shieka01');

INSERT INTO ADMIN
VALUES ('barbch01');

INSERT INTO ADMIN
VALUES ('russro01');

INSERT INTO ADMIN
VALUES ('wallca01');

INSERT INTO ADMIN
VALUES ('maloma01');

INSERT INTO ADMIN
VALUES ('gilmow01');

INSERT INTO ADMIN
VALUES ('cummbe01');

INSERT INTO ADMIN
VALUES ('tangyi02');

INSERT INTO BUYER
VALUES ('kentfr01', 10);

INSERT INTO BUYER
VALUES ('brooro01',15);

INSERT INTO BUYER
VALUES ('mossma01',8);

INSERT INTO BUYER
VALUES ('stanro01',97);

INSERT INTO BUYER
VALUES ('sullgr01',311);

INSERT INTO BUYER
VALUES ('wallca01',1);

INSERT INTO BUYER
VALUES ('maloma01',14);

INSERT INTO BUYER
VALUES ('myervi01',87);

INSERT INTO SELLER
VALUES ('kentfr01', 5, 87);

INSERT INTO SELLER
VALUES ('brooro01', NULL, 10);

INSERT INTO SELLER
VALUES ('mossma01', 2, NULL, 15);

INSERT INTO SELLER
VALUES ('stanro01', NULL, 8);

INSERT INTO SELLER
VALUES ('sullgr01', NULL, 97);

INSERT INTO SELLER
VALUES ('wallca01', 4.5, 311);

INSERT INTO SELLER
VALUES ('maloma01', 5, 1);

INSERT INTO SELLER
VALUES ('myervi01', 5, 14);

INSERT INTO BANS
VALUES ('gilmow01', 'smitke03');

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('Fundamentals of Physics Textbook', 'Very good', 1, 'Course Materials', NOW(), 'https://m.media-amazon.com/images/I/81+lwBghWBL._AC_UF1000,1000_QL80_.jpg', 'Very good condition Physics textbook for Physics 111', 'kentfr01', 29.99);

INSERT INTO ITEM (item_title, item_condition, item_size, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('Large Gettysburg T-Shirt', 'Good', 'Large', 1, 'Fashion', NOW(), 'https://images.footballfanatics.com/gettysburg-bullets/gettysburg-college-champion-jersey-short-sleeve-t-shirt-navy_ss10_p-100797648+u-tvvzialj6ngp73mi6qel+v-3ha6ijmm8mcg7ipnk28s.jpg?_hv=2&w=600', 'Good condition Large Gettysburg t-shirt', 'brooro01', 19.99);

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('TI-84 Calculator', 'Used', 1, 'Technology', NOW(), 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkIfHuv6AIK3y_XwGAorVYyDlq39GhGf55EL90vQ7d4wUDW6BNblqk2iM9FMp0j9OXNn0&usqp=CAU', 'Used but working TI-84 calculator', 'mossma01', 55.99);

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('ReMarkable', 'Very Good', 1, 'Technology', NOW(), 'https://m.media-amazon.com/images/I/71OL7PXfOeL.jpg', 'Good condition ReMarkable tablet', 'stanro01', 79.99);

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('Data Structures Textbook', 'Used', 1, 'Course Materials', NOW(), 'https://m.media-amazon.com/images/I/71kBRLo8ZtL._AC_UF1000,1000_QL80_.jpg', 'CS216 Textbook in not great condition but still usable', 'sullgr01', 29.99);

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, description, seller_username, price)
VALUES ('Gettysburg Notebook', 'New', 3, 'Student Essentials', NOW(), 'https://static.helixbeta.com/prod/8308/0268/8308_643120268.JPG', 'Never used Gettysburg notebook', 'wallca01', 5.99);

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, seller_username, price)
VALUES ('Acoustic Guitar', 'Good', 1, 'Entertainment', NOW(), 'https://upload.wikimedia.org/wikipedia/commons/4/45/GuitareClassique5.png', 'maloma01', 129.99);

INSERT INTO ITEM (item_title, item_condition, quantity, category, post_date, picture, seller_username, price)
VALUES ('Gettysburg Sticker', 'New', 1, 'Student Essentials', NOW(), 'https://ih1.redbubble.net/image.1196636959.2471/st,small,507x507-pad,600x600,f8f8f8.jpg', 'myervi01', 0.99);

INSERT INTO PURCHASES
VALUES(NOW(), 'myervi01', 1, 1);

INSERT INTO PURCHASES
VALUES(NOW(), 'mossma01', 8, 1);

INSERT INTO PURCHASES
VALUES(NOW(), 'stanro01', 3, 1);

INSERT INTO PURCHASES
VALUES(NOW(), 'sullgr01', 7, 1);

INSERT INTO PURCHASES
VALUES(NOW(), 'wallca01', 6, 1);

INSERT INTO PURCHASES
VALUES(NOW(), 'maloma01', 6, 1);

INSERT INTO PURCHASES
VALUES(NOW(), 'brooro01', 8, 2);

INSERT INTO PURCHASES
VALUES(NOW(), 'kentfr01', 8, 2);

INSERT INTO MESSAGES
VALUES(NULL, NOW(), "Code Jam Competition Announcement", "Were thrilled to announce the Code Jam Competition hosted by the Computer Science Club! Sharpen your coding skills and compete for exciting prizes. Register now and show off your coding prowess!", "kentfr01", "brooro01");


INSERT INTO MESSAGES
VALUES(NULL, NOW(), "Weekly Coding Workshop - Data Structures Focus", "Dive deep into data structures at our upcoming workshop this Thursday. Whether youre a beginner or an experienced coder, join us to enhance your skills and tackle coding challenges. Dont miss out – mark your calendar!", "mossama01", "jamebo01");


INSERT INTO MESSAGES
VALUES(NULL, NOW(), "Guest Speaker Series on AI and Machine Learning", "Exciting news! Were hosting a guest speaker series on AI and Machine Learning. Join us to gain insights from industry experts, learn about the latest trends, and explore career opportunities in these cutting-edge fields.", "wallca01", "stanro01");


INSERT INTO MESSAGES
VALUES(NULL, NOW(), "Hackathon Team Formation Event", "Form your dream hackathon team at our upcoming event! Whether you have a project idea or are looking to join a team, this is the perfect opportunity to connect with like-minded individuals and brainstorm innovative solutions.", "myervi01", "shieka01");


INSERT INTO MESSAGES
VALUES(NULL, NOW(), "Introduction to Cybersecurity Workshop", "Concerned about online security? Attend our Cybersecurity Workshop to learn essential skills and best practices. From encryption to threat detection, well cover it all.", "barbch01", "wallca01");


INSERT INTO MESSAGES
VALUES(NULL, NOW(), "Tech Industry Panel Discussion", "Gain insights into the tech industry at our upcoming panel discussion. Industry professionals will share their experiences, discuss trends, and answer your burning questions.", "russro01", "barbch01");


INSERT INTO MESSAGES
VALUES(NULL, NOW(), "Algorithms Study Group Kickoff", "Ready to conquer algorithms? Join our study group as we dive into various algorithms, share strategies, and work on problem-solving together. All skill levels are welcome!", "kentfr01", "brooro01");


INSERT INTO MESSAGES
VALUES(NULL, NOW(), "Software Development Workshop Series", "Embark on a journey to become a proficient software developer with our workshop series. From coding fundamentals to project development, this series will cover it all. ", "sullgr01", "stanro01");

INSERT INTO REVIEWS
VALUES(NULL, NOW(), 'Great condition!', 1, 5, 'myervi01');

INSERT INTO REVIEWS
VALUES(NULL, NOW(), 'Loved the sticker I put it on my laptop!', 8, 5, 'mossma01');

INSERT INTO REVIEWS
VALUES(NULL, NOW(), 'Battery life was really bad', 3, 2, 'stanro01');

INSERT INTO REVIEWS
VALUES(NULL, NOW(), 'Amazing guitar!', 7, 5, 'sullgr01');

INSERT INTO REVIEWS
VALUES(NULL, NOW(), 'Nice, affordable notebook!', 6, 5, 'wallca01');

INSERT INTO REVIEWS
VALUES(NULL, NOW(), 'Pretty good notebook', 6, 4, 'maloma01');

INSERT INTO REVIEWS
VALUES(NULL, NOW(), 'Great stickers!', 8, 5, 'brooro01');

INSERT INTO REVIEWS
VALUES(NULL, NOW(), 'These are awesome!', 8, 5, 'kentfr01');



