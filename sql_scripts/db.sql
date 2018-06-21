CREATE TABLE type_item(
	idtype_item SERIAL PRIMARY KEY,
	title VARCHAR NOT NULL UNIQUE,
	tax FLOAT NOT NULL
);

CREATE TABLE item(
	iditem SERIAL PRIMARY KEY,
	idtype_item INTEGER NOT NULL REFERENCES type_item on delete cascade,
	descr VARCHAR NOT NULL,
	price FLOAT NOT NULL
);

CREATE TABLE order_register(
	idorder_register SERIAL PRIMARY KEY,
	dtreg date DEFAULT (now()),
	total_amount FLOAT NOT NULL,
    total_tax FLOAT NOT NULL
);

CREATE TABLE item_order(
	iditem INTEGER NOT NULL REFERENCES item,
	idorder_register INTEGER NOT NULL REFERENCES order_register,
	price FLOAT NOT NULL,
	quantity INTEGER NOT NULL DEFAULT 1,
	total_amount FLOAT NOT NULL,
    total_tax FLOAT NOT NULL,
	PRIMARY KEY(iditem, idorder_register)
);