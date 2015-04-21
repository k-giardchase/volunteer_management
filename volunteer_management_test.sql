--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

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
-- Name: committees; Type: TABLE; Schema: public; Owner: Kyle; Tablespace: 
--

CREATE TABLE committees (
    id integer NOT NULL,
    committee_name character varying,
    department character varying,
    description character varying
);


ALTER TABLE committees OWNER TO "Kyle";

--
-- Name: committees_id_seq; Type: SEQUENCE; Schema: public; Owner: Kyle
--

CREATE SEQUENCE committees_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE committees_id_seq OWNER TO "Kyle";

--
-- Name: committees_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kyle
--

ALTER SEQUENCE committees_id_seq OWNED BY committees.id;


--
-- Name: committees_supervisors; Type: TABLE; Schema: public; Owner: Kyle; Tablespace: 
--

CREATE TABLE committees_supervisors (
    id integer NOT NULL,
    committee_id integer,
    supervisor_id integer
);


ALTER TABLE committees_supervisors OWNER TO "Kyle";

--
-- Name: committees_supervisors_id_seq; Type: SEQUENCE; Schema: public; Owner: Kyle
--

CREATE SEQUENCE committees_supervisors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE committees_supervisors_id_seq OWNER TO "Kyle";

--
-- Name: committees_supervisors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kyle
--

ALTER SEQUENCE committees_supervisors_id_seq OWNED BY committees_supervisors.id;


--
-- Name: events; Type: TABLE; Schema: public; Owner: Kyle; Tablespace: 
--

CREATE TABLE events (
    id integer NOT NULL,
    event_name character varying,
    event_date timestamp without time zone,
    location character varying
);


ALTER TABLE events OWNER TO "Kyle";

--
-- Name: events_id_seq; Type: SEQUENCE; Schema: public; Owner: Kyle
--

CREATE SEQUENCE events_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE events_id_seq OWNER TO "Kyle";

--
-- Name: events_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kyle
--

ALTER SEQUENCE events_id_seq OWNED BY events.id;


--
-- Name: events_volunteers; Type: TABLE; Schema: public; Owner: Kyle; Tablespace: 
--

CREATE TABLE events_volunteers (
    id integer NOT NULL,
    event_id integer,
    volunteer_id integer
);


ALTER TABLE events_volunteers OWNER TO "Kyle";

--
-- Name: events_volunteers_id_seq; Type: SEQUENCE; Schema: public; Owner: Kyle
--

CREATE SEQUENCE events_volunteers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE events_volunteers_id_seq OWNER TO "Kyle";

--
-- Name: events_volunteers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kyle
--

ALTER SEQUENCE events_volunteers_id_seq OWNED BY events_volunteers.id;


--
-- Name: supervisors; Type: TABLE; Schema: public; Owner: Kyle; Tablespace: 
--

CREATE TABLE supervisors (
    id integer NOT NULL,
    first_name character varying,
    last_name character varying,
    position_title character varying,
    email character varying,
    phone character varying
);


ALTER TABLE supervisors OWNER TO "Kyle";

--
-- Name: supervisors_id_seq; Type: SEQUENCE; Schema: public; Owner: Kyle
--

CREATE SEQUENCE supervisors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE supervisors_id_seq OWNER TO "Kyle";

--
-- Name: supervisors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kyle
--

ALTER SEQUENCE supervisors_id_seq OWNED BY supervisors.id;


--
-- Name: volunteers; Type: TABLE; Schema: public; Owner: Kyle; Tablespace: 
--

CREATE TABLE volunteers (
    id integer NOT NULL,
    first_name character varying,
    last_name character varying,
    email character varying,
    username character varying,
    password character varying,
    admin_stat integer
);


ALTER TABLE volunteers OWNER TO "Kyle";

--
-- Name: volunteers_id_seq; Type: SEQUENCE; Schema: public; Owner: Kyle
--

CREATE SEQUENCE volunteers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE volunteers_id_seq OWNER TO "Kyle";

--
-- Name: volunteers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kyle
--

ALTER SEQUENCE volunteers_id_seq OWNED BY volunteers.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Kyle
--

ALTER TABLE ONLY committees ALTER COLUMN id SET DEFAULT nextval('committees_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Kyle
--

ALTER TABLE ONLY committees_supervisors ALTER COLUMN id SET DEFAULT nextval('committees_supervisors_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Kyle
--

ALTER TABLE ONLY events ALTER COLUMN id SET DEFAULT nextval('events_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Kyle
--

ALTER TABLE ONLY events_volunteers ALTER COLUMN id SET DEFAULT nextval('events_volunteers_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Kyle
--

ALTER TABLE ONLY supervisors ALTER COLUMN id SET DEFAULT nextval('supervisors_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Kyle
--

ALTER TABLE ONLY volunteers ALTER COLUMN id SET DEFAULT nextval('volunteers_id_seq'::regclass);


--
-- Data for Name: committees; Type: TABLE DATA; Schema: public; Owner: Kyle
--

COPY committees (id, committee_name, department, description) FROM stdin;
\.


--
-- Name: committees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kyle
--

SELECT pg_catalog.setval('committees_id_seq', 1, false);


--
-- Data for Name: committees_supervisors; Type: TABLE DATA; Schema: public; Owner: Kyle
--

COPY committees_supervisors (id, committee_id, supervisor_id) FROM stdin;
\.


--
-- Name: committees_supervisors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kyle
--

SELECT pg_catalog.setval('committees_supervisors_id_seq', 1, false);


--
-- Data for Name: events; Type: TABLE DATA; Schema: public; Owner: Kyle
--

COPY events (id, event_name, event_date, location) FROM stdin;
11	Silent Auction	2015-01-01 12:00:00	202 Some Street
\.


--
-- Name: events_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kyle
--

SELECT pg_catalog.setval('events_id_seq', 11, true);


--
-- Data for Name: events_volunteers; Type: TABLE DATA; Schema: public; Owner: Kyle
--

COPY events_volunteers (id, event_id, volunteer_id) FROM stdin;
\.


--
-- Name: events_volunteers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kyle
--

SELECT pg_catalog.setval('events_volunteers_id_seq', 1, false);


--
-- Data for Name: supervisors; Type: TABLE DATA; Schema: public; Owner: Kyle
--

COPY supervisors (id, first_name, last_name, position_title, email, phone) FROM stdin;
\.


--
-- Name: supervisors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kyle
--

SELECT pg_catalog.setval('supervisors_id_seq', 1, false);


--
-- Data for Name: volunteers; Type: TABLE DATA; Schema: public; Owner: Kyle
--

COPY volunteers (id, first_name, last_name, email, username, password, admin_stat) FROM stdin;
1	Maggie	Doe	maggie@me.com	Mags123	1234	0
2	Johnny	Doe	johnny@me.com	John123	123456	1
\.


--
-- Name: volunteers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kyle
--

SELECT pg_catalog.setval('volunteers_id_seq', 2, true);


--
-- Name: committees_pkey; Type: CONSTRAINT; Schema: public; Owner: Kyle; Tablespace: 
--

ALTER TABLE ONLY committees
    ADD CONSTRAINT committees_pkey PRIMARY KEY (id);


--
-- Name: committees_supervisors_pkey; Type: CONSTRAINT; Schema: public; Owner: Kyle; Tablespace: 
--

ALTER TABLE ONLY committees_supervisors
    ADD CONSTRAINT committees_supervisors_pkey PRIMARY KEY (id);


--
-- Name: events_pkey; Type: CONSTRAINT; Schema: public; Owner: Kyle; Tablespace: 
--

ALTER TABLE ONLY events
    ADD CONSTRAINT events_pkey PRIMARY KEY (id);


--
-- Name: events_volunteers_pkey; Type: CONSTRAINT; Schema: public; Owner: Kyle; Tablespace: 
--

ALTER TABLE ONLY events_volunteers
    ADD CONSTRAINT events_volunteers_pkey PRIMARY KEY (id);


--
-- Name: supervisors_pkey; Type: CONSTRAINT; Schema: public; Owner: Kyle; Tablespace: 
--

ALTER TABLE ONLY supervisors
    ADD CONSTRAINT supervisors_pkey PRIMARY KEY (id);


--
-- Name: volunteers_pkey; Type: CONSTRAINT; Schema: public; Owner: Kyle; Tablespace: 
--

ALTER TABLE ONLY volunteers
    ADD CONSTRAINT volunteers_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: Kyle
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM "Kyle";
GRANT ALL ON SCHEMA public TO "Kyle";
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

