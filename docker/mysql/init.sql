/* データベース */

DROP DATABASE IF EXISTS posse;

CREATE DATABASE posse;

USE posse;

/* 問題テーブル */

DROP TABLE IF EXISTS questions;

CREATE TABLE
    questions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        content VARCHAR(255),
        image VARCHAR(255),
        supplement VARCHAR(255)
    ) CHARSET = utf8;

INSERT INTO
    questions (content, image, supplement)
VALUES (
        '日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか?',
        'img-quiz01.png',
        '経済産業省 2019年3月 - IT 人材需給に関する調査'
    ), (
        '既存業界のビジネスと、先進的なテクノロジーを結びつけて生まれた、新しいビジネスのことをなんと言うでしょう？',
        'img-quiz02.png',
        null
    ), (
        'IoTとは何の略でしょう？',
        'img-quiz03.png',
        null
    ), (
        '日本が目指すサイバー空間とフィジカル空間を高度に融合させたシステムによって開かれる未来社会のことをなんと言うでしょうか？',
        'img-quiz04.png',
        'Society5.0 - 科学技術政策 - 内閣府'
    ), (
        'イギリスのコンピューター科学者であるギャビン・ウッド氏が提唱した、ブロックチェーン技術を活用した「次世代分散型インターネット」のことをなんと言うでしょう？',
        'img-quiz05.png',
        null
    ), (
        '先進テクノロジー活用企業と出遅れた企業の収益性の差はどれくらいあると言われているでしょうか？',
        'img-quiz06.png',
        'Accenture Technology Vision 2021'
    );

/* 選択肢テーブル */

DROP TABLE IF EXISTS choices;

CREATE TABLE
    choices (
        id INT AUTO_INCREMENT PRIMARY KEY,
        question_id INT,
        name VARCHAR(255),
        valid boolean
        /* 問題作成処理が難しくなるため一旦コメントアウト
        /* FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE */
    ) CHARSET = utf8;

INSERT INTO
    choices (question_id, name, valid)
VALUES (1, '約28万人', 0), (1, '約79万人', 1), (1, '約183万人', 0), (2, 'INTECH', 0), (2, 'BIZZTECH', 0), (2, 'X-TECH', 1), (3, 'Internet of Things', 1), (
        3,
        'Integrate into Technology',
        0
    ), (3, 'Information  on Tool', 0), (4, 'Society 5.0', 1), (4, 'CyPhy', 0), (4, 'SDGs', 0), (5, 'Web3.0', 1), (5, 'NFT', 0), (5, 'メタバース', 0), (6, '約2倍', 0), (6, '約5倍', 1), (6, '約11倍', 0);

/* 管理者テーブル */

DROP TABLE IF EXISTS users;

CREATE TABLE
    users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        email VARCHAR(255),
        password VARCHAR(255)
    ) CHARSET = utf8;

insert into
    users (name, email, password)
values (
        "管理者1",
        "admin@example.com",
        "password"
    );

DROP TABLE IF EXISTS user_invitations;

CREATE TABLE
    user_invitations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        -- expired_at DATETIME,
        invited_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        activated_at DATETIME,
        token VARCHAR(255),
        FOREIGN KEY (user_id) REFERENCES users(id)
    ) CHARSET = utf8;

insert into
    user_invitations (
        user_id,
        invited_at,
        activated_at,
        token
    )
values (
        1,
        DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY),
        CURRENT_DATE,
        "token"
    );
