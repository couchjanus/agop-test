--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.19
-- Dumped by pg_dump version 9.5.19

-- Started on 2019-12-26 17:37:08 EET

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 192 (class 1259 OID 127444)
-- Name: category_product; Type: TABLE; Schema: public; Owner: dev
--

CREATE TABLE public.category_product (
    category_id bigint NOT NULL,
    product_id bigint NOT NULL
);


ALTER TABLE public.category_product OWNER TO dev;

--
-- TOC entry 2165 (class 0 OID 127444)
-- Dependencies: 192
-- Data for Name: category_product; Type: TABLE DATA; Schema: public; Owner: dev
--

COPY public.category_product (category_id, product_id) FROM stdin;

1	1
1	6
1	10
1	11

2	20
2	13
2	17
2	3

3	2
3	7
3	5
3	19

4	18
4	8
4	12
4	14
4	4

5	10
5	12
5	9
5	20
5	16

6	1
6	17
6	7
6	20

7	4
7	8
7	10
7	6
7	15

\.


--
-- TOC entry 2047 (class 1259 OID 127457)
-- Name: category_product_category_id_index; Type: INDEX; Schema: public; Owner: dev
--

CREATE INDEX category_product_category_id_index ON public.category_product USING btree (category_id);


--
-- TOC entry 2048 (class 1259 OID 127458)
-- Name: category_product_product_id_index; Type: INDEX; Schema: public; Owner: dev
--

CREATE INDEX category_product_product_id_index ON public.category_product USING btree (product_id);


--
-- TOC entry 2049 (class 2606 OID 127447)
-- Name: category_product_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: dev
--

ALTER TABLE ONLY public.category_product
    ADD CONSTRAINT category_product_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id);


--
-- TOC entry 2050 (class 2606 OID 127452)
-- Name: category_product_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: dev
--

ALTER TABLE ONLY public.category_product
    ADD CONSTRAINT category_product_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id);


-- Completed on 2019-12-26 17:37:08 EET

--
-- PostgreSQL database dump complete
--

