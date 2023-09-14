drop database VetDataBaseTeste;

create database VetDataBaseTeste;
use VetDataBaseTeste;



create table Funcoes
(
  idFuncao int primary key not null,
  descricao varchar(50) not null
);
insert into Funcoes (idFuncao, descricao)
values('1', 'Recepcionista'),
('2', 'Veterinário');




create table Usuarios
(
 id int auto_increment primary key,
 loginusuario varchar(50) NOT NULL,
 senha varchar(50) not null,
 nome varchar (150) not null,
 email varchar (150) not null,
 telefone varchar(20) not null,
 idFuncao int,
foreign key (idFuncao) references Funcoes(idFuncao)
);


insert into  Usuarios (nome, loginusuario, senha, email, telefone, idFuncao)
values ('João Silva', 'joao', 'joao', 'joao@example.com', '1234567890', 2),
('Gabriel Souza', 'gabriel', 'gabriel', 'gabriel@example.com', '9876543210', 1),
('Luiza', 'luiza', '$2y$10$0kNs4lXmcq5H9XtdRu/ixuWuUoWlnjYvJXWeOfeUL3YTuqxDQLUgS', 'luiza@example.com', 1346798520, 1),
('Margarida', 'maga', '$2y$10$FFQaRbqsqbPrkmV3fBf3ZOCI44gvOqu0Ix0mUur51qkexRQUXs02W', 'margarida@example.com', '7946130258', 2),
('Izaltino', 'tino', '$2y$10$YtS5vIFJIx6lAzJhS6Nzpe2zvdlCSyjiOr0DIFNZoArZAXQnjX0aq', 'izaltino@example.com', '1234569870', 1);

/* TESTE SELECT PARA CARGOS
select Usuarios.nome, Funcoes.descricao
from Usuarios inner join Funcoes on Usuarios.idFuncao = Funcoes.idFuncao
where Funcoes.descricao = 'Recepcionista';
*/


create table Clientes
(
 idCliente int auto_increment primary key,
 nome varchar (150) not null,
 email varchar (150),
 telefone varchar(20) not null
);
insert into Clientes (nome, email, telefone)
values ('Carlos Oliveira', 'carlos@example.com', '5555555555');




create table Animais
(
 idAnimal int auto_increment primary key,
 nome varchar(100) not null,
 especie varchar(50) not null,
 raca varchar(50) not null,
 datanascto date,
 proprietario int,
 idCliente int,
foreign key (idCliente) references Clientes(idCliente)
);

insert into Animais (nome, especie, raca, datanascto, idCliente)
values ('Bumi', 'Cão', 'Golden Retriever', '2018-03-15', 1),
('Sett', 'Gato', 'Siamês', '2019-06-10', 1),
('Tico', 'Pássaro', 'Canário', '2020-02-01', 1);

/* TESTE SELECT PARA DONO E ANIMAIS
select Clientes.nome, Animais.nome
from Clientes inner join Animais on Clientes.idCliente = Animais.idCliente;
*/



create table HistoricoMedico (
    idHistorico int auto_increment primary key,
    consulta int,
    dataconsulta date not null,
    diagnostico text,
    tratamento text,
    observacoes text,
    idAnimal int,
    foreign key (idAnimal) references Animais(idAnimal)
);

insert into HistoricoMedico (consulta, dataconsulta, diagnostico, tratamento, observacoes, idAnimal)
values (1, '2023-08-20', 'Exame físico normal', 'Nenhum tratamento necessário', 'Animal saudável', 1),
(2, '2023-08-18', 'Verificou-se vermifugação necessária', 'Administrar vermífugo', 'Próxima dose em 6 meses', 2),
(3, '2023-08-19', 'Infecção de ouvido', 'Prescrição de antibióticos', 'Retorno em uma semana para reavaliação', 3);

/* TESTE SELECT PARA ANIMAIS E HISTÓRICO MÉDICO
select Animais.nome, HistoricoMedico.observacoes
from Animais inner join HistoricoMedico on Animais.idAnimal = HistoricoMedico.idAnimal;
*/


create table Agenda
(
 idConsulta int auto_increment primary key,
 dataConsulta date not null,
 horaConsulta time not null, 
 veterinario int,
 descricao text,
 idAnimal int,
 foreign key (idAnimal) references Animais(idAnimal)
);
insert into Agenda (dataConsulta, horaConsulta, veterinario, idAnimal, descricao)
values ('2023-08-20', '14:00:00', 1, 1, 'Exame de rotina'),
('2023-08-18', '10:30:00', 1, 2, 'Vacinação'),
('2023-08-19', '16:15:00', 1, 3, 'Avaliação de saúde');

/* TESTE SELECT PARA ANIMAIS E AGENDA
select Animais.nome, Agenda.descricao
from Agenda inner join Animais on Animais.idAnimal = Agenda.idAnimal;
*/






select * from Usuarios;
select * from Clientes;
select * from Animais;
select * from Agenda;
select * from HistoricoMedico;


