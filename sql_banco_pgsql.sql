
CREATE TABLE public.tbracao (
                raccodigo INTEGER NOT NULL,
                racnome VARCHAR(20) NOT NULL,
                racdetalhe VARCHAR,
                facfoto VARCHAR,
                CONSTRAINT tbracao_pk PRIMARY KEY (raccodigo)
);


CREATE TABLE public.tbpeixe (
                peicodigo INTEGER NOT NULL,
                peinome VARCHAR(20) NOT NULL,
                peidetalhe VARCHAR,
                peifoto VARCHAR,
                CONSTRAINT tbpeixe_fk PRIMARY KEY (peicodigo)
);


CREATE TABLE public.tbassociacao (
                asccodigo INTEGER NOT NULL,
                ascnome VARCHAR(150) NOT NULL,
                CONSTRAINT tbassociacao_pk PRIMARY KEY (asccodigo)
);


CREATE TABLE public.tbequipamento (
                eqpcodigo INTEGER NOT NULL,
                asccodigo INTEGER NOT NULL,
                eqpnome VARCHAR(30) NOT NULL,
                eqpimagem VARCHAR(50),
                eqpstatus SMALLINT NOT NULL,
                eqpprecodia NUMERIC(5,2) NOT NULL,
                eqpdetalhe VARCHAR,
                eqpquantidade INTEGER NOT NULL,
                CONSTRAINT tbequipamento_pk PRIMARY KEY (eqpcodigo)
);


CREATE TABLE public.tbpessoa (
                pescodigo INTEGER NOT NULL,
                pesnomerazao VARCHAR(50) NOT NULL,
                pescpfcnpj VARCHAR(20) NOT NULL,
                pesrg VARCHAR(14) NOT NULL,
                pestipo SMALLINT NOT NULL,
                pesemail VARCHAR(30),
                CONSTRAINT tbpessoa_pk PRIMARY KEY (pescodigo)
);


CREATE TABLE public.tbcomprador (
                comcodigo INTEGER NOT NULL,
                pescodigo INTEGER NOT NULL,
                comtipo SMALLINT NOT NULL,
                CONSTRAINT tbcomprador_pk PRIMARY KEY (comcodigo)
);


CREATE TABLE public.tbcompraproducao (
                cpdnumero INTEGER NOT NULL,
                cpddetalhe VARCHAR,
                cpdvalor NUMERIC(5,2) NOT NULL,
                comcodigo INTEGER NOT NULL,
                peicodigo INTEGER NOT NULL,
                CONSTRAINT tbcompraproducao_pk PRIMARY KEY (cpdnumero)
);


CREATE TABLE public.tbpedido (
                pednumero INTEGER NOT NULL,
                pescodigo INTEGER NOT NULL,
                pedstatus SMALLINT NOT NULL,
                pedvalor NUMERIC(8,2) NOT NULL,
                CONSTRAINT tbpedido_pk PRIMARY KEY (pednumero)
);


CREATE TABLE public.tbusuario (
                usucodigo INTEGER NOT NULL,
                ususenha VARCHAR(50) NOT NULL,
                pescodigo INTEGER NOT NULL,
                CONSTRAINT tbusuario_pk PRIMARY KEY (usucodigo)
);


CREATE TABLE public.tbfornecedor (
                forcodigo INTEGER NOT NULL,
                pescodigo INTEGER NOT NULL,
                fortipo SMALLINT NOT NULL,
                CONSTRAINT tbfornecedor_pk PRIMARY KEY (forcodigo)
);


CREATE TABLE public.tbproduto (
                procodigo INTEGER NOT NULL,
                forcodigo INTEGER NOT NULL,
                prodescricao VARCHAR,
                CONSTRAINT tbproduto_pk PRIMARY KEY (procodigo)
);


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


CREATE TABLE public.tbmembro (
                memcodigo INTEGER NOT NULL,
                asccodigo INTEGER NOT NULL,
                pescodigo INTEGER NOT NULL,
                memativo SMALLINT NOT NULL,
                memsituacao SMALLINT NOT NULL,
                memtipo SMALLINT NOT NULL,
                CONSTRAINT tbmembro_pk PRIMARY KEY (memcodigo)
);


CREATE TABLE public.tbvendaproducao (
                vennumero INTEGER NOT NULL,
                memcodigo INTEGER NOT NULL,
                venpesomediotipo NUMERIC(5,2) NOT NULL,
                venpreco NUMERIC(5,2) NOT NULL,
                vendetalhe VARCHAR,
                peicodigo INTEGER NOT NULL,
                CONSTRAINT tbvendaproducao_pk PRIMARY KEY (vennumero)
);


CREATE TABLE public.tbnegociacao (
                negcodigo INTEGER NOT NULL,
                vennumero INTEGER NOT NULL,
                cpdnumero INTEGER NOT NULL,
                negstatus SMALLINT NOT NULL,
                negproposta NUMERIC(8,2) NOT NULL,
                CONSTRAINT tbnegociacao_pk PRIMARY KEY (negcodigo)
);


CREATE TABLE public.tbaluguel (
                alunumero INTEGER NOT NULL,
                aluposfila INTEGER NOT NULL,
                memcodigo INTEGER NOT NULL,
                aludatainicio DATE NOT NULL,
                aludatafim DATE NOT NULL,
                aluvalor NUMERIC(8,2) NOT NULL,
                CONSTRAINT tbaluguel_pk PRIMARY KEY (alunumero)
);


CREATE TABLE public.tbequipaluguel (
                alunumero INTEGER NOT NULL,
                eqpcodigo INTEGER NOT NULL,
                CONSTRAINT tbequipaluguel_pk PRIMARY KEY (alunumero, eqpcodigo)
);


ALTER TABLE public.tbprodutoracao ADD CONSTRAINT tbracao_tbprodracao_fk
FOREIGN KEY (raccodigo)
REFERENCES public.tbracao (raccodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbprodutopeixe ADD CONSTRAINT tbtipopeixe_tbprodpeixe_fk
FOREIGN KEY (peicodigo)
REFERENCES public.tbpeixe (peicodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbvendaproducao ADD CONSTRAINT tbtipopeixe_tbvendaprod_fk
FOREIGN KEY (peicodigo)
REFERENCES public.tbpeixe (peicodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbcompraproducao ADD CONSTRAINT tbtipopeixe_tbcompraprod_fk
FOREIGN KEY (peicodigo)
REFERENCES public.tbpeixe (peicodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbmembro ADD CONSTRAINT tbassociacao_tbmembro_fk
FOREIGN KEY (asccodigo)
REFERENCES public.tbassociacao (asccodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbequipamento ADD CONSTRAINT tbassociacao_tbequipamento_fk
FOREIGN KEY (asccodigo)
REFERENCES public.tbassociacao (asccodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbequipaluguel ADD CONSTRAINT tbequipamento_tbequipaluguel_fk
FOREIGN KEY (eqpcodigo)
REFERENCES public.tbequipamento (eqpcodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbmembro ADD CONSTRAINT tbpessoa_tbmembro_fk
FOREIGN KEY (pescodigo)
REFERENCES public.tbpessoa (pescodigo)
ON DELETE CASCADE
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
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbcomprador ADD CONSTRAINT tbpessoa_tbcomprador_fk
FOREIGN KEY (pescodigo)
REFERENCES public.tbpessoa (pescodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbcompraproducao ADD CONSTRAINT tbcomprador_tbcompraprod_fk
FOREIGN KEY (comcodigo)
REFERENCES public.tbcomprador (comcodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbnegociacao ADD CONSTRAINT tbcompraprod_tbnegociacao_fk
FOREIGN KEY (cpdnumero)
REFERENCES public.tbcompraproducao (cpdnumero)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbpedidoproduto ADD CONSTRAINT tbpedido_tbpedprod_fk
FOREIGN KEY (pednumero)
REFERENCES public.tbpedido (pednumero)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbproduto ADD CONSTRAINT tbfornecedor_tbproduto_fk
FOREIGN KEY (forcodigo)
REFERENCES public.tbfornecedor (forcodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbpedidoproduto ADD CONSTRAINT tbproduto_tbpedprod_fk
FOREIGN KEY (procodigo)
REFERENCES public.tbproduto (procodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbprodutoracao ADD CONSTRAINT tbproduto_tbprodracao_fk
FOREIGN KEY (procodigo)
REFERENCES public.tbproduto (procodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbprodutopeixe ADD CONSTRAINT tbproduto_tbprodpeixe_fk
FOREIGN KEY (procodigo)
REFERENCES public.tbproduto (procodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbaluguel ADD CONSTRAINT tbmembro_tbaluguel_fk
FOREIGN KEY (memcodigo)
REFERENCES public.tbmembro (memcodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbvendaproducao ADD CONSTRAINT tbmembro_tbvendaprod_fk
FOREIGN KEY (memcodigo)
REFERENCES public.tbmembro (memcodigo)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbnegociacao ADD CONSTRAINT tbvendaprod_tbnegociacao_fk
FOREIGN KEY (vennumero)
REFERENCES public.tbvendaproducao (vennumero)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.tbequipaluguel ADD CONSTRAINT tbaluguel_tbequipaluguel_fk
FOREIGN KEY (alunumero)
REFERENCES public.tbaluguel (alunumero)
ON DELETE CASCADE
ON UPDATE NO ACTION
NOT DEFERRABLE;
