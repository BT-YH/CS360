CREATE TABLE USER (
    username        VARCHAR(15)       PRIMARY KEY,
    fname           VARCHAR(20)       NOT NULL,
    lname           VARCHAR(20)       NOT NULL,
    dob             DATE              NOT NULL,
    password        VARCHAR(20)       NOT NULL    
)


CREATE TABLE ADMIN (
    admin_username    VARCHAR(15)       PRIMARY KEY,
    FOREIGN KEY(admin_username) REFERENCES  USER(username)  
)


CREATE TABLE END_USER (
    end_username     VARCHAR(15)       PRIMARY KEY,
    end_address     VARCHAR(255),
    FOREIGN KEY(end_username) REFERENCES  USER(username)  
)

CREATE TABLE SELLER (
    seller_username     VARCHAR(15)       PRIMARY KEY,
    rating              INT,
    items_sold          INT,
    FOREIGN KEY(seller_username) REFERENCES END_USER(end_username) 
);


CREATE TABLE BUYER (
    buyer_username      VARCHAR(15)       PRIMARY KEY,
    items_bought        INT,
    FOREIGN KEY(buyer_username) REFERENCES END_USER(end_username) 
);


CREATE TABLE MODERATES (
    admin_username   VARCHAR(15)      NOT NULL,
    end_username     VARCHAR(15)      NOT NULL,
    end_status       VARCHAR(15)      NOT NULL,
    FOREIGN KEY(admin_username) REFERENCES  USER(username),
    FOREIGN KEY(end_username)   REFERENCES  USER(username),
)


CREATE TABLE REVIEWS (
    revid           INT    AUTO_INCREMENT            PRIMARY KEY,
    rev_date        DATETIME          NOT NULL,
    rev_content     VARCHAR(150)      NOT NULL,
    item_id         INT               NOT NULL,
    rating          INT               NOT NULL,
    buyer_username      VARCHAR(15)       NOT NULL,
    FOREIGN KEY(item_id)  REFERENCES  ITEM(iid),      
    FOREIGN KEY(buyer_username) REFERENCES  BUYER(buyer_username)   
);



CREATE TABLE ITEM (
    iid             INT       AUTO_INCREMENT   PRIMARY KEY,
    item_condition            VARCHAR(10),
    item_size            VARCHAR(10),
    quantity        INT,
    category        VARCHAR(20)       NOT NULL,
    post_date       DATETIME          NOT NULL,
    picture         VARCHAR(250),     
    description     VARCHAR(150),
    seller_username VARCHAR(15)      NOT NULL,
    price           DECIMAL(8,2)          NOT NULL,
    FOREIGN KEY(seller_username)  REFERENCES  SELLER(seller_username)      
);

CREATE TABLE SOLD_ITEMS (
    iid             INT          PRIMARY KEY,
    buyer_username  VARCHAR(15)  NOT NULL,
    FOREIGN KEY(buyer_username)   REFERENCES BUYER(buyer_username) 
);


CREATE TABLE MESSAGES (
    mid             INT         AUTO_INCREMENT      PRIMARY KEY,
    msg_date        DATETIME          NOT NULL,
    msg_subject     VARCHAR(20),
    msg_content     VARCHAR(1000)     NOT NULL,
    sender_username VARCHAR(15)       NOT NULL,
    rec_username    VARCHAR(15)       NOT NULL,
    FOREIGN KEY(sender_username)    REFERENCES USER(username),
    FOREIGN KEY(rec_username) REFERENCES USER(username)
);



CREATE TABLE BUYS (
    date_bought        DATETIME              NOT NULL,
    buyer_username     VARCHAR(15)       NOT NULL,
    item_id            INT               NOT NULL,
    quantity           INT               NOT NULL,
    PRIMARY KEY(buyer_username, item_id, date_bought),
    FOREIGN KEY(buyer_username)    REFERENCES BUYER(buyer_username),
    FOREIGN KEY(item_id) REFERENCES ITEM(iid)
);
