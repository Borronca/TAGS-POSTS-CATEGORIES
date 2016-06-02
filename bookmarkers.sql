CREATE TABLE categories (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  url varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


CREATE TABLE posts (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  category_id int(11) NOT NULL,
  title varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  slug varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  content text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  author varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  published tinyint(1) NOT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL,
  FOREIGN KEY category_key (category_id) REFERENCES categories(id) -- tem que colocar on cascade --
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE tags (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL,
  UNIQUE KEY (title)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE posts_tags (
  post_id int(11) NOT NULL,
  tag_id int(11) NOT NULL,
  PRIMARY KEY (post_id, tag_id),
  INDEX tag_idx (tag_id, post_id),
  FOREIGN KEY tag_key(tag_id) REFERENCES tags(id),
  FOREIGN KEY post_key(post_id) REFERENCES posts(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
