--
-- PostgreSQL database dump
--

-- Dumped from database version 14.1
-- Dumped by pg_dump version 14.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: product_types; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.product_types (
    id character varying(96) NOT NULL,
    name character varying(255)
);


ALTER TABLE public.product_types OWNER TO admin;

--
-- Name: products; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.products (
    id character varying(96) NOT NULL,
    name character varying(255),
    type_id character varying(96),
    price numeric(10,2)
);


ALTER TABLE public.products OWNER TO admin;

--
-- Name: sale_items; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.sale_items (
    id character varying(96) NOT NULL,
    sale_id character varying(96),
    product_id character varying(96),
    quantity integer
);


ALTER TABLE public.sale_items OWNER TO admin;

--
-- Name: sales; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.sales (
    id character varying(96) NOT NULL,
    subtotal numeric(10,2),
    taxes numeric(10,2),
    total numeric(10,2),
    sale_date date
);


ALTER TABLE public.sales OWNER TO admin;

--
-- Name: taxes; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.taxes (
    id character varying(96) NOT NULL,
    type_id character varying(96),
    percentage numeric(5,2)
);


ALTER TABLE public.taxes OWNER TO admin;

--
-- Data for Name: product_types; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.product_types (id, name) FROM stdin;
1	Eletrônicos
2	Roupas
3	Alimentos
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.products (id, name, type_id, price) FROM stdin;
1	Smartphone	1	1500.00
2	Notebook	1	3000.00
3	Camiseta	2	50.00
4	Calça	2	80.00
5	Arroz	3	5.00
\.


--
-- Data for Name: sale_items; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.sale_items (id, sale_id, product_id, quantity) FROM stdin;
1	1	1	2
2	1	3	4
3	2	5	10
4	3	2	1
5	4	4	3
6	5	1	1
\.


--
-- Data for Name: sales; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.sales (id, subtotal, taxes, total, sale_date) FROM stdin;
1	2000.00	200.00	2200.00	2022-01-01
2	130.00	6.50	136.50	2022-02-15
3	150.00	0.00	150.00	2022-03-10
4	250.00	12.50	262.50	2022-04-05
5	100.00	5.00	105.00	2022-05-20
\.


--
-- Data for Name: taxes; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.taxes (id, type_id, percentage) FROM stdin;
1	1	10.00
2	2	5.00
3	3	0.00
\.


--
-- Name: product_types product_types_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.product_types
    ADD CONSTRAINT product_types_pkey PRIMARY KEY (id);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- Name: sale_items sale_items_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.sale_items
    ADD CONSTRAINT sale_items_pkey PRIMARY KEY (id);


--
-- Name: sales sales_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_pkey PRIMARY KEY (id);


--
-- Name: taxes taxes_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.taxes
    ADD CONSTRAINT taxes_pkey PRIMARY KEY (id);


--
-- Name: products products_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_type_id_fkey FOREIGN KEY (type_id) REFERENCES public.product_types(id);


--
-- Name: sale_items sale_items_product_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.sale_items
    ADD CONSTRAINT sale_items_product_id_fkey FOREIGN KEY (product_id) REFERENCES public.products(id);


--
-- Name: sale_items sale_items_sale_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.sale_items
    ADD CONSTRAINT sale_items_sale_id_fkey FOREIGN KEY (sale_id) REFERENCES public.sales(id);


--
-- Name: taxes taxes_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.taxes
    ADD CONSTRAINT taxes_type_id_fkey FOREIGN KEY (type_id) REFERENCES public.product_types(id);


--
-- PostgreSQL database dump complete
--

