CREATE TABLE USER (
    username        VARCHAR(15)       PRIMARY KEY,
    fname           VARCHAR(20)       NOT NULL,
    lname           VARCHAR(20)       NOT NULL,
    date_of_birth   DATE              NOT NULL,
    pswd            VARCHAR(20)       NOT NULL,    
)


CREATE TABLE ADMIN (
    admin_username    VARCHAR(15)       PRIMARY KEY,
    FOREIGN KEY(admin_username) REFERENCES  USER(username)  
)


CREATE TABLE END_USER (
    end_username     VARCHAR(15)       PRIMARY KEY,
    user_address     VARCHAR(255),
    user_status      BOOLEAN           NOT NULL,
    FOREIGN KEY(end_username) REFERENCES  USER(username)  
)


CREATE TABLE SELLER (
    seller_name     VARCHAR(15)       PRIMARY KEY,
    rating          INT,
    items_sold      INT,
    FOREIGN KEY(seller_name) REFERENCES END_USER(username) 
);


CREATE TABLE BUYER (
    buyer_name      VARCHAR(15)       PRIMARY KEY,
    items_bought    INT,
    FOREIGN KEY(buyer_name) REFERENCES END_USER(username) 
);


CREATE TABLE moderates (
    admin_username   VARCHAR(15)      NOT NULL,
    end_username     VARCHAR(15)      NOT NULL,

    FOREIGN KEY(admin_username) REFERENCES  USER(username),
    FOREIGN KEY(end_username)   REFERENCES  USER(username),
)


CREATE TABLE REVIEWS (
    revid           INT               PRIMARY KEY  AUTO_INCREMENT,
    rev_date        TIME              NOT NULL,
    rev_content     VARCHAR(150)      NOT NULL,
    item_id         INT               NOT NULL,
    rating          INT               NOT NULL,
    buyer_name      VARCHAR(15)       NOT NULL,
    FOREIGN KEY(item_id)  REFERENCES  ITEM(iid),      
    FOREIGN KEY(buyer_name) REFERENCES  BUYER(buyer_name)   
);



CREATE TABLE ITEM (
    iid             INT          PRIMARY KEY  AUTO_INCREMENT,
    condition       VARCHAR(10),
    size            VARCHAR(10),
    quantity        INT,
    category        VARCHAR(20)       NOT NULL,
    post_date       TIME              NOT NULL,
    picture         BOOLEAN           NOT NULL,
    descrp          VARCHAR(150),
    buyer_name      VARCHAR(15),
    seller_name     VARCHAR(15),
    price           DEC(8,2)          NOT NULL,
    FOREIGN KEY(seller_name)  REFERENCES  END_USER(username),      
    FOREIGN KEY(buyer_name) REFERENCES  END_USER(username)   
);


CREATE TABLE MESSAGES (
    mid             INT               PRIMARY KEY  AUTO_INCREMENT
    msg_date        TIME              NOT NULL,
    msg_subject     VARCHAR(20),
    msg_content     VARCHAR(1000)     NOT NULL,
    sender_name     VARCHAR(15)       NOT NULL,
    recipient_name  VARCHAR(15)       NOT NULL,
    FOREIGN KEY(sender_id)    REFERENCES USER(username),
    FOREIGN KEY(recipient_id) REFERENCES USER(username),
);



CREATE TABLE BUYS (
    date_bought        TIME              NOT NULL,
    buyer_name         VARCHAR(15)       NOT NULL,
    item_id            INT               NOT NULL,
    quantity           INT               NOT NULL,
    PRIMARY KEY(buyer_name, item_id, date_bought),
    FOREIGN KEY(buyer_name)    REFERENCES BUYER(buyer_name),
    FOREIGN KEY(item_id) REFERENCES ITEM(iid),
);
