DELIMITER $$
CREATE PROCEDURE insertCategory(IN category_name VARCHAR(255))
BEGIN
    INSERT INTO categories(category_title) VALUE(category_name);
END
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE deleteCategory(IN categoryID INT)
BEGIN
    DELETE FROM categories WHERE category_id = categoryID;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE updateCategory(IN categoryID INT, IN cat_title VARCHAR(255))
BEGIN
    UPDATE categories SET category_title = cat_title WHERE category_id = categoryID;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE viewsCounter(IN p_id INT)
BEGIN
    UPDATE posts SET post_views = post_views + 1 WHERE post_id = p_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE registerUser(IN p_username VARCHAR(255), IN p_email VARCHAR(255), IN p_password VARCHAR(255))
BEGIN
    INSERT INTO users(user_nickname, user_password, user_email) VALUES(p_username, p_password, p_email);
END$$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE addUser(
    IN p_nickname VARCHAR(255),
    IN p_first_name VARCHAR(255),
    IN p_last_name VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_role VARCHAR(255),
    IN p_avatar TEXT) 
BEGIN
    INSERT INTO users(
        user_nickname,
        user_first_name,
        user_last_name,
        user_password,
        user_email,
        user_role,
        user_avatar
    ) 
    VALUES(
        p_nickname,
        p_first_name,
        p_last_name,
        p_password,
        p_email,
        p_role,
        p_avatar
    );
END$$
DELIMITER ;



DELIMITER $$
CREATE PROCEDURE updateUser(
    IN p_id_user INT,
    IN p_nickname VARCHAR(255),
    IN p_first_name VARCHAR(255),
    IN p_last_name VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_role VARCHAR(255),
    IN p_avatar TEXT) 
BEGIN
    UPDATE users SET 
        user_nickname = p_nickname,
        user_first_name = p_first_name,
        user_last_name = p_last_name,
        user_password = p_password,
        user_email = p_email,
        user_role = p_role,
        user_avatar = p_avatar 
    WHERE user_id = p_id_user;
END$$
DELIMITER ;



DELIMITER $$
CREATE PROCEDURE deleteUser(IN p_id INT)
BEGIN
    DELETE FROM users WHERE user_id = p_id;
END$$
DELIMITER ;

-- Eliminar comentario:
DELIMITER $$
CREATE PROCEDURE deleteComment(IN p_comment_id INT)
BEGIN
    DELETE FROM comments WHERE comment_id = p_comment_id;
END$$
DELIMITER ;


-- Aprobar

DELIMITER $$
CREATE PROCEDURE approveStatus(IN p_id INT)
BEGIN
    UPDATE comments SET comment_status = "approved" WHERE comment_id = p_id;
END$$
DELIMITER ;

-- No aprobar


DELIMITER $$
CREATE PROCEDURE unapproveStatus(IN p_id INT)
BEGIN
    UPDATE comments SET comment_status = "unapproved" WHERE comment_id = p_id;
END$$
DELIMITER ;



DELIMITER $$
CREATE PROCEDURE insertComment(
    IN p_post_id INT, 
    IN p_author VARCHAR(255), 
    IN p_email VARCHAR(255),
    IN p_content TEXT,
    IN p_date DATE
    )
BEGIN
    INSERT INTO comments(
        comment_post_id,
        comment_author,
        comment_email,
        comment_content,
        comment_date
    ) 
    VALUES(
        p_post_id,
        p_author,
        p_email,
        p_content,
        p_date
    ) 
END$$
DELIMITER ;



DELIMITER $$
CREATE PROCEDURE updatePost(
        IN p_id INT,
        IN p_category INT, 
        IN p_title VARCHAR(255),
        IN p_autor VARCHAR(255),
        IN p_image TEXT,
        IN p_content TEXT,
        IN p_tags VARCHAR(255),
        IN p_status VARCHAR(255)
)
BEGIN
    UPDATE posts SET 
        post_category_id = p_category,
        post_title = p_title,
        post_author = p_autor,
        post_image = p_image,
        post_content = p_content,
        post_tags = p_tags,
        post_status = p_status
        WHERE post_id = p_id;
END$$
DELIMITER ;



DELIMITER $$
CREATE PROCEDURE insertPosts(
        IN p_category INT, 
        IN p_title VARCHAR(255),
        IN p_autor VARCHAR(255),
        IN p_date DATE,
        IN p_image TEXT,
        IN p_content TEXT,
        IN p_tags VARCHAR(255),
        IN p_status VARCHAR(255)
)
BEGIN
    INSERT INTO posts(
        post_category_id,
        post_title,
        post_author,
        post_date,
        post_image,
        post_content,
        post_tags,
        post_status
    ) VALUES(
        p_category,
        p_title,
        p_autor,
        p_date,
        p_image,
        p_content,
        p_tags,
        p_status
    );
END$$
DELIMITER ;

CREATE TRIGGER count_comments 
AFTER INSERT ON comments
    FOR EACH ROW 
    INSERT INTO posts
    SET
        post_comment_count = post_comment_count+1;


create trigger Table1Trigger after insert on Table1
   -> for each row
   -> begin
   ->  insert into Table2(id, name) values (new.id, new.name);
   -> end#

DELIMITER $$
CREATE trigger count_comments AFTER INSERT ON comments
FOR EACH ROW
BEGIN
    UPDATE posts SET post_comment_count = post_comment_count+1 WHERE post_id = 
END$$
DELIMITER ;