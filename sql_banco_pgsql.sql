
CREATE SEQUENCE public.tbracao_raccodigo_seq;

CREATE TABLE public.tbracao (
                raccodigo INTEGER NOT NULL DEFAULT nextval('public.tbracao_raccodigo_seq'),
                racnome VARCHAR(20) NOT NULL,
                racdetalhe VARCHAR,
                facfoto VARCHAR,
                CONSTRAINT tbracao_pk PRIMARY KEY (raccodigo)
);


ALTER SEQUENCE public.tbracao_raccodigo_seq OWNED BY public.tbracao.raccodigo;

CREATE SEQUENCE public.tbpeixe_peicodigo_seq;

CREATE TABLE public.tbpeixe (
                peicodigo INTEGER NOT NULL DEFAULT nextval('public.tbpeixe_peicodigo_seq'),
                peinome VARCHAR(20) NOT NULL,
                peidetalhe VARCHAR,
                peifoto VARCHAR,
                CONSTRAINT tbpeixe_fk PRIMARY KEY (peicodigo)
);


ALTER SEQUENCE public.tbpeixe_peicodigo_seq OWNED BY public.tbpeixe.peicodigo;

CREATE SEQUENCE public.tbassociacao_asccodigo_seq;

CREATE TABLE public.tbassociacao (
                asccodigo INTEGER NOT NULL DEFAULT nextval('public.tbassociacao_asccodigo_seq'),
                ascnome VARCHAR(150) NOT NULL,
                CONSTRAINT tbassociacao_pk PRIMARY KEY (asccodigo)
);


ALTER SEQUENCE public.tbassociacao_asccodigo_seq OWNED BY public.tbassociacao.asccodigo;

CREATE SEQUENCE public.tbequipamento_eqpcodigo_seq;

CREATE TABLE public.tbequipamento (
                eqpcodigo INTEGER NOT NULL DEFAULT nextval('public.tbequipamento_eqpcodigo_seq'),
                eqpnome VARCHAR(30) NOT NULL,
                eqpimagem VARCHAR(50),
                eqpstatus SMALLINT NOT NULL,
                eqpprecodia NUMERIC(5,2) NOT NULL,
                eqpdetalhe VARCHAR,
                eqpquantidade INTEGER NOT NULL,
                asccodigo INTEGER NOT NULL,
                CONSTRAINT tbequipamento_pk PRIMARY KEY (eqpcodigo)
);


ALTER SEQUENCE public.tbequipamento_eqpcodigo_seq OWNED BY public.tbequipamento.eqpcodigo;

CREATE SEQUENCE public.tbpessoa_pescodigo_seq;

CREATE TABLE public.tbpessoa (
                pescodigo INTEGER NOT NULL DEFAULT nextval('public.tbpessoa_pescodigo_seq'),
                pesnomerazao VARCHAR(50) NOT NULL,
                pescpfcnpj VARCHAR(20) NOT NULL,
                pesrg VARCHAR(14) NOT NULL,
                pestipo SMALLINT NOT NULL,
                pesemail VARCHAR(30) NOT NULL,
                CONSTRAINT tbpessoa_pk PRIMARY KEY (pescodigo)
);


ALTER SEQUENCE public.tbpessoa_pescodigo_seq OWNED BY public.tbpessoa.pescodigo;

CREATE SEQUENCE public.tbcomprador_comcodigo_seq;

CREATE TABLE public.tbcomprador (
                comcodigo INTEGER NOT NULL DEFAULT nextval('public.tbcomprador_comcodigo_seq'),
                comtipo SMALLINT NOT NULL,
                pescodigo INTEGER NOT NULL,
                CONSTRAINT tbcomprador_pk PRIMARY KEY (comcodigo)
);


ALTER SEQUENCE public.tbcomprador_comcodigo_seq OWNED BY public.tbcomprador.comcodigo;

CREATE SEQUENCE public.tbcompraproducao_cpdnumero_seq;

CREATE TABLE public.tbcompraproducao (
                cpdnumero INTEGER NOT NULL DEFAULT nextval('public.tbcompraproducao_cpdnumero_seq'),
                cpddetalhe VARCHAR,
                cpdvalor NUMERIC(5,2) NOT NULL,
                comcodigo INTEGER NOT NULL,
                peicodigo INTEGER NOT NULL,
                CONSTRAINT tbcompraproducao_pk PRIMARY KEY (cpdnumero)
);


ALTER SEQUENCE public.tbcompraproducao_cpdnumero_seq OWNED BY public.tbcompraproducao.cpdnumero;

CREATE SEQUENCE public.tbpedido_pednumero_seq;

CREATE TABLE public.tbpedido (
                pednumero INTEGER NOT NULL DEFAULT nextval('public.tbpedido_pednumero_seq'),
                pescodigo INTEGER NOT NULL,
                pedstatus SMALLINT NOT NULL,
                pedvalor NUMERIC(8,2) NOT NULL,
                CONSTRAINT tbpedido_pk PRIMARY KEY (pednumero)
);


ALTER SEQUENCE public.tbpedido_pednumero_seq OWNED BY public.tbpedido.pednumero;

CREATE SEQUENCE public.tbusuario_usucodigo_seq;

CREATE TABLE public.tbusuario (
                usucodigo INTEGER NOT NULL DEFAULT nextval('public.tbusuario_usucodigo_seq'),
                ususenha VARCHAR(150) NOT NULL,
                usutipo SMALLINT NOT NULL,
                pescodigo INTEGER NOT NULL,
                remember_token VARCHAR(150),
                CONSTRAINT tbusuario_pk PRIMARY KEY (usucodigo)
);


ALTER SEQUENCE public.tbusuario_usucodigo_seq OWNED BY public.tbusuario.usucodigo;

CREATE SEQUENCE public.tbfornecedor_forcodigo_seq;

CREATE TABLE public.tbfornecedor (
                forcodigo INTEGER NOT NULL DEFAULT nextval('public.tbfornecedor_forcodigo_seq'),
                fortipo SMALLINT NOT NULL,
                pescodigo INTEGER NOT NULL,
                CONSTRAINT tbfornecedor_pk PRIMARY KEY (forcodigo)
);


ALTER SEQUENCE public.tbfornecedor_forcodigo_seq OWNED BY public.tbfornecedor.forcodigo;

CREATE SEQUENCE public.tbproduto_procodigo_seq;

CREATE TABLE public.tbproduto (
                procodigo INTEGER NOT NULL DEFAULT nextval('public.tbproduto_procodigo_seq'),
                prodescricao VARCHAR,
                forcodigo INTEGER NOT NULL,
                CONSTRAINT tbproduto_pk PRIMARY KEY (procodigo)
);


ALTER SEQUENCE public.tbproduto_procodigo_seq OWNED BY public.tbproduto.procodigo;

CREATE TABLE public.tbprodutopeixe (
                procodigo INTEGER NOT NULL,
                peicodigo INTEGER NOT NULL,
                CONSTRAINT tbprodutopeixe_pk PRIMARY KEY (procodigo, peicodigo)
);


CREATE TABLE public.tbprodutoracao (
                procodigo INTEGER NOT NULL,
                raccodigo INTEGER NOT NULL,
                CONSTRAINT tbprodutoracao_pk PRIMARY KEY (procodigo, raccodigo)
);


CREATE TABLE public.tbpedidoproduto (
                procodigo INTEGER NOT NULL,
                pednumero INTEGER NOT NULL,
                ppdquantidade NUMERIC(5,2) NOT NULL,
                CONSTRAINT tbpedidoproduto_pk PRIMARY KEY (procodigo, pednumero)
);


CREATE SEQUENCE public.tbmembro_memcodigo_seq;

CREATE TABLE public.tbmembro (
                memcodigo INTEGER NOT NULL DEFAULT nextval('public.tbmembro_memcodigo_seq'),
                memativo SMALLINT NOT NULL,
                memsituacao SMALLINT NOT NULL,
                memtipo SMALLINT NOT NULL,
                asccodigo INTEGER NOT NULL,
                pescodigo INTEGER NOT NULL,
                CONSTRAINT tbmembro_pk PRIMARY KEY (memcodigo)
);


ALTER SEQUENCE public.tbmembro_memcodigo_seq OWNED BY public.tbmembro.memcodigo;

CREATE SEQUENCE public.tbvendaproducao_vennumero_seq;

CREATE TABLE public.tbvendaproducao (
                vennumero INTEGER NOT NULL DEFAULT nextval('public.tbvendaproducao_vennumero_seq'),
                venpesomediotipo NUMERIC(5,2) NOT NULL,
                venpreco NUMERIC(5,2) NOT NULL,
                vendetalhe VARCHAR,
                memcodigo INTEGER NOT NULL,
                peicodigo INTEGER NOT NULL,
                CONSTRAINT tbvendaproducao_pk PRIMARY KEY (vennumero)
);


ALTER SEQUENCE public.tbvendaproducao_vennumero_seq OWNED BY public.tbvendaproducao.vennumero;

CREATE SEQUENCE public.tbnegociacao_negcodigo_seq;

CREATE TABLE public.tbnegociacao (
                negcodigo INTEGER NOT NULL DEFAULT nextval('public.tbnegociacao_negcodigo_seq'),
                negstatus SMALLINT NOT NULL,
                negproposta NUMERIC(8,2) NOT NULL,
                vennumero INTEGER NOT NULL,
                cpdnumero INTEGER NOT NULL,
                CONSTRAINT tbnegociacao_pk PRIMARY KEY (negcodigo)
);


ALTER SEQUENCE public.tbnegociacao_negcodigo_seq OWNED BY public.tbnegociacao.negcodigo;

CREATE SEQUENCE public.tbaluguel_alunumero_seq;

CREATE TABLE public.tbaluguel (
                alunumero INTEGER NOT NULL DEFAULT nextval('public.tbaluguel_alunumero_seq'),
                alustatus SMALLINT NOT NULL,
                aludatainicio DATE NOT NULL,
                aludatafim DATE NOT NULL,
                aluvalor NUMERIC(8,2) NOT NULL,
                memcodigo INTEGER NOT NULL,
                CONSTRAINT tbaluguel_pk PRIMARY KEY (alunumero)
);


ALTER SEQUENCE public.tbaluguel_alunumero_seq OWNED BY public.tbaluguel.alunumero;

CREATE SEQUENCE public.tbfilaaluguel_filnumero_seq;

CREATE TABLE public.tbfilaaluguel (
                filnumero INTEGER NOT NULL DEFAULT nextval('public.tbfilaaluguel_filnumero_seq'),
                alunumero INTEGER NOT NULL,
                CONSTRAINT tbfilaaluguel_pk PRIMARY KEY (filnumero)
);


ALTER SEQUENCE public.tbfilaaluguel_filnumero_seq OWNED BY public.tbfilaaluguel.filnumero;

CREATE TABLE public.tbequipaluguel (
                alunumero INTEGER NOT NULL,
                eqpcodigo INTEGER NOT NULL,
                eqaquantidade SMALLINT DEFAULT 1 NOT NULL,
                CONSTRAINT tbequipaluguel_pk PRIMARY KEY (alunumero, eqpcodigo)
);


ALTER TABLE public.tbprodutoracao ADD CONSTRAINT tbracao_tbprodracao_fk
FOREIGN KEY (raccodigo)
REFERENCES public.tbracao (raccodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbprodutopeixe ADD CONSTRAINT tbtipopeixe_tbprodpeixe_fk
FOREIGN KEY (peicodigo)
REFERENCES public.tbpeixe (peicodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbvendaproducao ADD CONSTRAINT tbtipopeixe_tbvendaprod_fk
FOREIGN KEY (peicodigo)
REFERENCES public.tbpeixe (peicodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbcompraproducao ADD CONSTRAINT tbtipopeixe_tbcompraprod_fk
FOREIGN KEY (peicodigo)
REFERENCES public.tbpeixe (peicodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbmembro ADD CONSTRAINT tbassociacao_tbmembro_fk
FOREIGN KEY (asccodigo)
REFERENCES public.tbassociacao (asccodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbequipamento ADD CONSTRAINT tbassociacao_tbequipamento_fk
FOREIGN KEY (asccodigo)
REFERENCES public.tbassociacao (asccodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbequipaluguel ADD CONSTRAINT tbequipamento_tbequipaluguel_fk
FOREIGN KEY (eqpcodigo)
REFERENCES public.tbequipamento (eqpcodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbmembro ADD CONSTRAINT tbpessoa_tbmembro_fk
FOREIGN KEY (pescodigo)
REFERENCES public.tbpessoa (pescodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbfornecedor ADD CONSTRAINT tbpessoa_tbfornecedor_fk
FOREIGN KEY (pescodigo)
REFERENCES public.tbpessoa (pescodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbusuario ADD CONSTRAINT tbpessoa_tbusuario_fk
FOREIGN KEY (pescodigo)
REFERENCES public.tbpessoa (pescodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbpedido ADD CONSTRAINT tbpessoa_tbpedido_fk
FOREIGN KEY (pescodigo)
REFERENCES public.tbpessoa (pescodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbcomprador ADD CONSTRAINT tbpessoa_tbcomprador_fk
FOREIGN KEY (pescodigo)
REFERENCES public.tbpessoa (pescodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbcompraproducao ADD CONSTRAINT tbcomprador_tbcompraprod_fk
FOREIGN KEY (comcodigo)
REFERENCES public.tbcomprador (comcodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbnegociacao ADD CONSTRAINT tbcompraprod_tbnegociacao_fk
FOREIGN KEY (cpdnumero)
REFERENCES public.tbcompraproducao (cpdnumero)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbpedidoproduto ADD CONSTRAINT tbpedido_tbpedprod_fk
FOREIGN KEY (pednumero)
REFERENCES public.tbpedido (pednumero)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbproduto ADD CONSTRAINT tbfornecedor_tbproduto_fk
FOREIGN KEY (forcodigo)
REFERENCES public.tbfornecedor (forcodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbpedidoproduto ADD CONSTRAINT tbproduto_tbpedprod_fk
FOREIGN KEY (procodigo)
REFERENCES public.tbproduto (procodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbprodutoracao ADD CONSTRAINT tbproduto_tbprodracao_fk
FOREIGN KEY (procodigo)
REFERENCES public.tbproduto (procodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbprodutopeixe ADD CONSTRAINT tbproduto_tbprodpeixe_fk
FOREIGN KEY (procodigo)
REFERENCES public.tbproduto (procodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbaluguel ADD CONSTRAINT tbmembro_tbaluguel_fk
FOREIGN KEY (memcodigo)
REFERENCES public.tbmembro (memcodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbvendaproducao ADD CONSTRAINT tbmembro_tbvendaprod_fk
FOREIGN KEY (memcodigo)
REFERENCES public.tbmembro (memcodigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbnegociacao ADD CONSTRAINT tbvendaprod_tbnegociacao_fk
FOREIGN KEY (vennumero)
REFERENCES public.tbvendaproducao (vennumero)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbequipaluguel ADD CONSTRAINT tbaluguel_tbequipaluguel_fk
FOREIGN KEY (alunumero)
REFERENCES public.tbaluguel (alunumero)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbfilaaluguel ADD CONSTRAINT tbaluguel_tbfilaaluguel_fk
FOREIGN KEY (alunumero)
REFERENCES public.tbaluguel (alunumero)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;