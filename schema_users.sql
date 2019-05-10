CREATE USER 'admin'@'localhost' identified by 'p@ssw0rd';
CREATE USER 'customer'@'localhost' identified by 'p@ssw0rd';
CREATE USER 'manager'@'localhost' identified by 'p@ssw0rd';
CREATE USER 'guest'@'localhost' identified by 'p@ssw0rd';

use BookStore;

GRANT SELECT on BookStore.users TO 'guest'@'localhost';
GRANT EXECUTE on PROCEDURE LOGIN TO 'guest'@'localhost';


GRANT ALL on BookStore.active_carts TO 'customer'@'localhost';
GRANT SELECT on BookStore.authors TO 'customer'@'localhost';
GRANT SELECT on BookStore.books TO 'customer'@'localhost';
GRANT SELECT on BookStore.book_editions TO 'customer'@'localhost';
GRANT SELECT on BookStore.book_isbns TO 'customer'@'localhost';
GRANT ALL on BookStore.items TO 'customer'@'localhost';
GRANT SELECT on BookStore.roles To 'customer'@'localhost';
GRANT SELECT on BookStore.model_has_roles To 'customer'@'localhost';
GRANT SELECT on BookStore.model_has_permissions To 'customer'@'localhost';
GRANT SELECT on BookStore.permissions To 'customer'@'localhost';
GRANT SELECT on BookStore.role_has_permissions To 'customer'@'localhost';
GRANT SELECT on BookStore.role_credentials To 'customer'@'localhost';
GRANT EXECUTE ON  BookStore.* TO 'customer'@'localhost';

GRANT ALL on BookStore.* TO 'admin'@'localhost';
GRANT ALL on BookStore.* TO 'manager'@'localhost';