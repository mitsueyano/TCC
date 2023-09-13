
drop database VetDataBase;


create database VetDataBase;
use VetDataBase;

create table Usuarios
(
 id int auto_increment primary key,
 nome varchar (150) not null,
 email varchar (150) not null,
 telefone varchar(20) not null,
 funcao varchar(50) not null
);
insert into  Usuarios (Nome, Email, Telefone, Funcao)
values ('João Silva', 'joao@example.com', '1234567890', 'Veterinário'),
('Gabriel Souza', 'gabriel@example.com', '9876543210', 'Recepcionista');


create table Clientes
(
 id int auto_increment primary key,
 nome varchar (150) not null,
 email varchar (150),
 telefone varchar(20) not null
);
insert into Clientes (nome, email, telefone)
values ('Carlos Oliveira', 'carlos@example.com', '5555555555');


create table Animais
(
 id int auto_increment primary key,
 nome varchar(100) not null,
 especie varchar(50) not null,
 raca varchar(50) not null,
 datanascto date,
 proprietario int,
 foreign key (proprietario) references Clientes(id)
);
insert into Animais (nome, especie, raca, datanascto, proprietario)
values ('Bumi', 'Cão', 'Golden Retriever', '2018-03-15', 1),
('Sett', 'Gato', 'Siamês', '2019-06-10', 1),
('Tico', 'Pássaro', 'Canário', '2020-02-01', 1);



create table Agenda
(
 id int auto_increment primary key,
 datahora datetime not null,
 veterinario int,
 animal int,
 descricao text,
 foreign key (veterinario) references Usuarios(id),
 foreign key (animal) references Animais(id)
);
insert into Agenda (datahora, veterinario, animal, descricao)
values ('2023-08-20 14:00:00', 1, 1, 'Exame de rotina'),
('2023-08-18 10:30:00', 1, 2, 'Vacinação'),
('2023-08-19 16:15:00', 1, 3, 'Avaliação de saúde');


create table HistoricoMedico (
    id int auto_increment primary key,
    consulta int,
    dataconsulta date not null,
    diagnostico text,
    tratamento text,
    observacoes text,
    foreign key (consulta) references Agenda(ID)
);
insert into HistoricoMedico (consulta, dataconsulta, diagnostico, tratamento, observacoes)
values (1, '2023-08-20', 'Exame físico normal', 'Nenhum tratamento necessário', 'Animal saudável'),
(2, '2023-08-18', 'Verificou-se vermifugação necessária', 'Administrar vermífugo', 'Próxima dose em 6 meses'),
(3, '2023-08-19', 'Infecção de ouvido', 'Prescrição de antibióticos', 'Retorno em uma semana para reavaliação');

select * from Usuarios;
select * from Clientes;
select * from Animais;
select * from Agenda;
select * from HistoricoMedico;


CREATE TABLE UserLogin (
  id int(11) NOT NULL DEFAULT 0 primary key,
  nome varchar(50) NOT NULL,
  loginusuario varchar(20) NOT NULL,
  senha varchar(150) NOT NULL
);

INSERT INTO UserLogin (id, nome, loginusuario, senha) 
values (1, 'Luiza', 'luiza', '$2y$10$0kNs4lXmcq5H9XtdRu/ixuWuUoWlnjYvJXWeOfeUL3YTuqxDQLUgS'),
(2, 'Margarida', 'maga', '$2y$10$FFQaRbqsqbPrkmV3fBf3ZOCI44gvOqu0Ix0mUur51qkexRQUXs02W'),
(3, 'Izaltino', 'tino', '$2y$10$YtS5vIFJIx6lAzJhS6Nzpe2zvdlCSyjiOr0DIFNZoArZAXQnjX0aq');

select * from UserLogin