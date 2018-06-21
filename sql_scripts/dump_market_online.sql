--
-- PostgreSQL database dump
--

-- Dumped from database version 10.1
-- Dumped by pg_dump version 10.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: item; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE item (
    iditem integer NOT NULL,
    idtype_item integer NOT NULL,
    descr character varying NOT NULL,
    price double precision NOT NULL
);


ALTER TABLE item OWNER TO postgres;

--
-- Name: item_iditem_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE item_iditem_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE item_iditem_seq OWNER TO postgres;

--
-- Name: item_iditem_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE item_iditem_seq OWNED BY item.iditem;


--
-- Name: item_order; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE item_order (
    iditem integer NOT NULL,
    idorder_register integer NOT NULL,
    price double precision NOT NULL,
    quantity integer DEFAULT 1 NOT NULL,
    total_amount double precision NOT NULL,
    total_tax double precision NOT NULL
);


ALTER TABLE item_order OWNER TO postgres;

--
-- Name: order_register; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE order_register (
    idorder_register integer NOT NULL,
    dtreg date DEFAULT now(),
    total_amount double precision NOT NULL,
    total_tax double precision NOT NULL
);


ALTER TABLE order_register OWNER TO postgres;

--
-- Name: order_register_idorder_register_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE order_register_idorder_register_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE order_register_idorder_register_seq OWNER TO postgres;

--
-- Name: order_register_idorder_register_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE order_register_idorder_register_seq OWNED BY order_register.idorder_register;


--
-- Name: type_item; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE type_item (
    idtype_item integer NOT NULL,
    title character varying NOT NULL,
    tax double precision NOT NULL
);


ALTER TABLE type_item OWNER TO postgres;

--
-- Name: type_item_idtype_item_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE type_item_idtype_item_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE type_item_idtype_item_seq OWNER TO postgres;

--
-- Name: type_item_idtype_item_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE type_item_idtype_item_seq OWNED BY type_item.idtype_item;


--
-- Name: item iditem; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY item ALTER COLUMN iditem SET DEFAULT nextval('item_iditem_seq'::regclass);


--
-- Name: order_register idorder_register; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY order_register ALTER COLUMN idorder_register SET DEFAULT nextval('order_register_idorder_register_seq'::regclass);


--
-- Name: type_item idtype_item; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY type_item ALTER COLUMN idtype_item SET DEFAULT nextval('type_item_idtype_item_seq'::regclass);


--
-- Data for Name: item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY item (iditem, idtype_item, descr, price) FROM stdin;
37	1	Arroz 1Kg	6.09999999999999964
38	1	Feijao 1kg	7.40000000000000036
39	9	Macarrao 500g	3.64999999999999991
40	14	Papel A4	8
\.


--
-- Data for Name: item_order; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY item_order (iditem, idorder_register, price, quantity, total_amount, total_tax) FROM stdin;
37	12	6.09999999999999964	1	6.09999999999999964	0.304999999999999993
38	12	7.40000000000000036	2	14.8000000000000007	0.739999999999999991
39	12	3.64999999999999991	4	14.5999999999999996	0.386900000000000022
37	13	6.09999999999999964	1	6.09999999999999964	0.304999999999999993
38	13	7.40000000000000036	2	14.8000000000000007	0.739999999999999991
39	13	3.64999999999999991	4	14.5999999999999996	0.386900000000000022
37	14	6.09999999999999964	1	6.09999999999999964	0.304999999999999993
38	14	7.40000000000000036	3	22.1999999999999993	1.1100000000000001
38	15	7.40000000000000036	4	29.6000000000000014	1.47999999999999998
39	15	3.64999999999999991	10	36.5	0.967250000000000054
37	19	6.09999999999999964	1	6.09999999999999964	0.304999999999999993
39	19	3.64999999999999991	1	3.64999999999999991	0.0967250000000000054
38	19	7.40000000000000036	1	7.40000000000000036	0.369999999999999996
\.


--
-- Data for Name: order_register; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY order_register (idorder_register, dtreg, total_amount, total_tax) FROM stdin;
12	2018-06-21	35.5	1.43189999999999995
13	2018-06-21	35.5	1.43189999999999995
14	2018-06-21	28.3000000000000007	1.41500000000000004
15	2018-06-21	511.399999999999977	14.2477
19	2018-06-21	34.2999999999999972	1.54344999999999999
20	2018-06-21	95.1500000000000057	4.67172500000000035
\.


--
-- Data for Name: type_item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY type_item (idtype_item, title, tax) FROM stdin;
1	GRAOS	5
4	ENLATADO	0.900000000000000022
6	FRUTA	0
7	VENENO	2.79999999999999982
9	MASSA	2.64999999999999991
10	MOLHOS	12
11	LEGUMES	2.10000000000000009
13	BRINQUEDO	20.5
14	ECRITORIO	0.0500000000000000028
\.


--
-- Name: item_iditem_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('item_iditem_seq', 40, true);


--
-- Name: order_register_idorder_register_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('order_register_idorder_register_seq', 20, true);


--
-- Name: type_item_idtype_item_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('type_item_idtype_item_seq', 15, true);


--
-- Name: item_order item_order_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY item_order
    ADD CONSTRAINT item_order_pkey PRIMARY KEY (iditem, idorder_register);


--
-- Name: item item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY item
    ADD CONSTRAINT item_pkey PRIMARY KEY (iditem);


--
-- Name: order_register order_register_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY order_register
    ADD CONSTRAINT order_register_pkey PRIMARY KEY (idorder_register);


--
-- Name: type_item type_item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY type_item
    ADD CONSTRAINT type_item_pkey PRIMARY KEY (idtype_item);


--
-- Name: type_item type_item_title_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY type_item
    ADD CONSTRAINT type_item_title_key UNIQUE (title);


--
-- Name: item item_idtype_item_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY item
    ADD CONSTRAINT item_idtype_item_fkey FOREIGN KEY (idtype_item) REFERENCES type_item(idtype_item) ON DELETE CASCADE;


--
-- Name: item_order item_order_iditem_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY item_order
    ADD CONSTRAINT item_order_iditem_fkey FOREIGN KEY (iditem) REFERENCES item(iditem);


--
-- Name: item_order item_order_idorder_register_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY item_order
    ADD CONSTRAINT item_order_idorder_register_fkey FOREIGN KEY (idorder_register) REFERENCES order_register(idorder_register);


--
-- PostgreSQL database dump complete
--

