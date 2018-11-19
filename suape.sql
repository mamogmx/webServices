--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.10
-- Dumped by pg_dump version 9.6.10

-- Started on 2018-11-19 17:20:52

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;
SET row_security = off;

--
-- TOC entry 23 (class 2615 OID 18855)
-- Name: suape; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA suape;


ALTER SCHEMA suape OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1070 (class 1259 OID 991781)
-- Name: catasto; Type: TABLE; Schema: suape; Owner: postgres
--

CREATE TABLE suape.catasto (
    id integer NOT NULL,
    pratica integer,
    data json,
    tms timestamp without time zone DEFAULT now()
);


ALTER TABLE suape.catasto OWNER TO postgres;

--
-- TOC entry 1069 (class 1259 OID 991779)
-- Name: catasto_id_seq; Type: SEQUENCE; Schema: suape; Owner: postgres
--

CREATE SEQUENCE suape.catasto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE suape.catasto_id_seq OWNER TO postgres;

--
-- TOC entry 7170 (class 0 OID 0)
-- Dependencies: 1069
-- Name: catasto_id_seq; Type: SEQUENCE OWNED BY; Schema: suape; Owner: postgres
--

ALTER SEQUENCE suape.catasto_id_seq OWNED BY suape.catasto.id;


--
-- TOC entry 1072 (class 1259 OID 991793)
-- Name: comunicazioni; Type: TABLE; Schema: suape; Owner: postgres
--

CREATE TABLE suape.comunicazioni (
    id integer NOT NULL,
    pratica integer,
    data json,
    tms timestamp without time zone DEFAULT now()
);


ALTER TABLE suape.comunicazioni OWNER TO postgres;

--
-- TOC entry 1071 (class 1259 OID 991791)
-- Name: comunicazioni_id_seq; Type: SEQUENCE; Schema: suape; Owner: postgres
--

CREATE SEQUENCE suape.comunicazioni_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE suape.comunicazioni_id_seq OWNER TO postgres;

--
-- TOC entry 7171 (class 0 OID 0)
-- Dependencies: 1071
-- Name: comunicazioni_id_seq; Type: SEQUENCE OWNED BY; Schema: suape; Owner: postgres
--

ALTER SEQUENCE suape.comunicazioni_id_seq OWNED BY suape.comunicazioni.id;


--
-- TOC entry 1062 (class 1259 OID 991730)
-- Name: documenti; Type: TABLE; Schema: suape; Owner: postgres
--

CREATE TABLE suape.documenti (
    id integer NOT NULL,
    pratica integer,
    data json,
    tms timestamp without time zone DEFAULT now()
);


ALTER TABLE suape.documenti OWNER TO postgres;

--
-- TOC entry 1061 (class 1259 OID 991728)
-- Name: documenti_id_seq; Type: SEQUENCE; Schema: suape; Owner: postgres
--

CREATE SEQUENCE suape.documenti_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE suape.documenti_id_seq OWNER TO postgres;

--
-- TOC entry 7172 (class 0 OID 0)
-- Dependencies: 1061
-- Name: documenti_id_seq; Type: SEQUENCE OWNED BY; Schema: suape; Owner: postgres
--

ALTER SEQUENCE suape.documenti_id_seq OWNED BY suape.documenti.id;


--
-- TOC entry 1066 (class 1259 OID 991754)
-- Name: pratica; Type: TABLE; Schema: suape; Owner: postgres
--

CREATE TABLE suape.pratica (
    id integer NOT NULL,
    pratica integer,
    data json,
    tms timestamp without time zone DEFAULT now()
);


ALTER TABLE suape.pratica OWNER TO postgres;

--
-- TOC entry 1065 (class 1259 OID 991752)
-- Name: pratica_id_seq; Type: SEQUENCE; Schema: suape; Owner: postgres
--

CREATE SEQUENCE suape.pratica_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE suape.pratica_id_seq OWNER TO postgres;

--
-- TOC entry 7173 (class 0 OID 0)
-- Dependencies: 1065
-- Name: pratica_id_seq; Type: SEQUENCE OWNED BY; Schema: suape; Owner: postgres
--

ALTER SEQUENCE suape.pratica_id_seq OWNED BY suape.pratica.id;


--
-- TOC entry 1064 (class 1259 OID 991742)
-- Name: procedimenti; Type: TABLE; Schema: suape; Owner: postgres
--

CREATE TABLE suape.procedimenti (
    id integer NOT NULL,
    pratica integer,
    data json,
    tms timestamp without time zone DEFAULT now()
);


ALTER TABLE suape.procedimenti OWNER TO postgres;

--
-- TOC entry 1063 (class 1259 OID 991740)
-- Name: procedimenti_id_seq; Type: SEQUENCE; Schema: suape; Owner: postgres
--

CREATE SEQUENCE suape.procedimenti_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE suape.procedimenti_id_seq OWNER TO postgres;

--
-- TOC entry 7174 (class 0 OID 0)
-- Dependencies: 1063
-- Name: procedimenti_id_seq; Type: SEQUENCE OWNED BY; Schema: suape; Owner: postgres
--

ALTER SEQUENCE suape.procedimenti_id_seq OWNED BY suape.procedimenti.id;


--
-- TOC entry 1068 (class 1259 OID 991769)
-- Name: ubicazione; Type: TABLE; Schema: suape; Owner: postgres
--

CREATE TABLE suape.ubicazione (
    id integer NOT NULL,
    pratica integer,
    data json,
    tms timestamp without time zone DEFAULT now()
);


ALTER TABLE suape.ubicazione OWNER TO postgres;

--
-- TOC entry 1067 (class 1259 OID 991767)
-- Name: ubicazione_id_seq; Type: SEQUENCE; Schema: suape; Owner: postgres
--

CREATE SEQUENCE suape.ubicazione_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE suape.ubicazione_id_seq OWNER TO postgres;

--
-- TOC entry 7175 (class 0 OID 0)
-- Dependencies: 1067
-- Name: ubicazione_id_seq; Type: SEQUENCE OWNED BY; Schema: suape; Owner: postgres
--

ALTER SEQUENCE suape.ubicazione_id_seq OWNED BY suape.ubicazione.id;


--
-- TOC entry 6727 (class 2604 OID 991784)
-- Name: catasto id; Type: DEFAULT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.catasto ALTER COLUMN id SET DEFAULT nextval('suape.catasto_id_seq'::regclass);


--
-- TOC entry 6729 (class 2604 OID 991796)
-- Name: comunicazioni id; Type: DEFAULT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.comunicazioni ALTER COLUMN id SET DEFAULT nextval('suape.comunicazioni_id_seq'::regclass);


--
-- TOC entry 6719 (class 2604 OID 991733)
-- Name: documenti id; Type: DEFAULT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.documenti ALTER COLUMN id SET DEFAULT nextval('suape.documenti_id_seq'::regclass);


--
-- TOC entry 6723 (class 2604 OID 991757)
-- Name: pratica id; Type: DEFAULT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.pratica ALTER COLUMN id SET DEFAULT nextval('suape.pratica_id_seq'::regclass);


--
-- TOC entry 6721 (class 2604 OID 991745)
-- Name: procedimenti id; Type: DEFAULT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.procedimenti ALTER COLUMN id SET DEFAULT nextval('suape.procedimenti_id_seq'::regclass);


--
-- TOC entry 6725 (class 2604 OID 991772)
-- Name: ubicazione id; Type: DEFAULT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.ubicazione ALTER COLUMN id SET DEFAULT nextval('suape.ubicazione_id_seq'::regclass);


--
-- TOC entry 6740 (class 2606 OID 991790)
-- Name: catasto catasto_pkey; Type: CONSTRAINT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.catasto
    ADD CONSTRAINT catasto_pkey PRIMARY KEY (id);


--
-- TOC entry 6742 (class 2606 OID 991802)
-- Name: comunicazioni comunicazioni_pkey; Type: CONSTRAINT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.comunicazioni
    ADD CONSTRAINT comunicazioni_pkey PRIMARY KEY (id);


--
-- TOC entry 6732 (class 2606 OID 991739)
-- Name: documenti docuemnti_pkey; Type: CONSTRAINT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.documenti
    ADD CONSTRAINT docuemnti_pkey PRIMARY KEY (id);


--
-- TOC entry 6736 (class 2606 OID 991763)
-- Name: pratica pratica_pkey; Type: CONSTRAINT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.pratica
    ADD CONSTRAINT pratica_pkey PRIMARY KEY (id);


--
-- TOC entry 6734 (class 2606 OID 991751)
-- Name: procedimenti procedimenti_pkey; Type: CONSTRAINT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.procedimenti
    ADD CONSTRAINT procedimenti_pkey PRIMARY KEY (id);


--
-- TOC entry 6738 (class 2606 OID 991778)
-- Name: ubicazione ubicazione_pkey; Type: CONSTRAINT; Schema: suape; Owner: postgres
--

ALTER TABLE ONLY suape.ubicazione
    ADD CONSTRAINT ubicazione_pkey PRIMARY KEY (id);


-- Completed on 2018-11-19 17:20:53

--
-- PostgreSQL database dump complete
--

