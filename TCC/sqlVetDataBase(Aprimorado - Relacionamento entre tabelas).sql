drop database VetDataBase;

 

create database VetDataBase;
use VetDataBase;

 

 

create table Funcoes
(
  idCargo int primary key not null,
  descricao varchar(50) not null
);
insert into Funcoes (idCargo, descricao)
values('1', 'Recepcionista'),
('2', 'Veterinário');

 

 

 

create table Usuarios
(
	idUsuario int auto_increment primary key not null,
	nome varchar (150) not null,
	email varchar (150) not null,
	contato varchar(20) not null,
    enderecoE varchar (2) not null,
    enderecoC varchar (50) not null,
    enderecoB varchar (50) not null,
    enderecoRN varchar (100) not null,
	idCargo int not null,
	foreign key (idCargo) references Funcoes(idCargo)
);

insert into  Usuarios (nome, email, contato, idCargo, enderecoE, enderecoC, enderecoB, enderecoRN)
values ('João Silva', 'joao@example.com', '1234567890', 2, 'SP', 'São Paulo', 'Jaguaré', 'Avenida Jaguaré, 125'),
('Gabriel Souza', 'gabriel@example.com', '9876543210', 1, 'SP', 'São Paulo', 'Santana', 'Praça Orlando Silva, 126'),
('Luiza', 'luiza@example.com', 1346798520, 1, 'SP', 'São Paulo', 'Jardim Santo André', 'Rua Conde de Ericeira, 127'),
('Margarida', 'margarida@example.com', '7946130258', 2, 'SP', 'São Paulo', 'Vila Paiva', 'Rua Santo Anselmo, 128'),
('Izaltino', 'izaltino@example.com', '1234569870', 1,'SP', 'São Paulo', 'Mandaqui', 'Rua Benjamin Ferreira, 129');

 

/* TESTE SELECT PARA CARGOS
select Usuarios.nome, Funcoes.descricao
from Usuarios inner join Funcoes on Usuarios.idFuncao = Funcoes.idFuncao
where Funcoes.descricao = 'Recepcionista';
*/

 

create table Acesso(
	idAcesso int auto_increment primary key,
	loginusuario varchar(50) not null,
	senha varchar(150) not null,
	idUsuario int,
	foreign key (idUsuario) references Usuarios(idUsuario)
);

insert into Acesso (loginusuario, senha, idusuario)
values ('joao', 'joao', 1), /*Não funciona - Não criptografado*/
('gabriel', 'gabriel', 2), /*Não funciona - Não criptografado*/
('luiza', '$2y$10$0kNs4lXmcq5H9XtdRu/ixuWuUoWlnjYvJXWeOfeUL3YTuqxDQLUgS', 3),
('maga', '$2y$10$FFQaRbqsqbPrkmV3fBf3ZOCI44gvOqu0Ix0mUur51qkexRQUXs02W', 4),
('tino', '$2y$10$YtS5vIFJIx6lAzJhS6Nzpe2zvdlCSyjiOr0DIFNZoArZAXQnjX0aq', 5);

 

/* TESTE SELECT PARA LOGINUSUARIO E NOME
select Acesso.loginusuario, Usuarios.nome
from Acesso inner join Usuarios on Acesso.idUsuario = Usuarios.idUsuario;
*/

 

 

create table Clientes
(
	idCliente int auto_increment primary key,
	nome varchar (150) not null,
	email varchar (150),
	contato varchar(20) not null,
    enderecoE varchar (2),
    enderecoC varchar (50),
    enderecoB varchar (50),
    enderecoRN varchar (100) 
);
insert into Clientes (nome, email, contato, enderecoE, enderecoC, enderecoB, enderecoRN)
values ('Carlos Oliveira', 'carlos@example.com', '(85) 3727-5073', 'SP', 'Mauá', 'Vila Noêmia', 'Rua Jasson Marques, 123' ),
('Kaique Henrique', 'kaique@example.com', '(85) 99469-6139', 'SP', 'Mauá', 'Vila Noêmia', 'Rua Jasson Marques, 124' );



 

 

create table Animais
(
	idAnimal int auto_increment primary key,
	nome varchar(100) not null,
	especie varchar(50) not null,
	raca varchar(50) not null,
	datanascto date,
	idCliente int not null,
	foreign key (idCliente) references Clientes(idCliente)
);

 

insert into Animais (nome, especie, raca, datanascto, idCliente)
values ('Bumi', 'Cachorro', 'Golden Retriever', '2018-03-15', 1),
('Sett', 'Gato', 'Siamês', '2019-06-10', 1),
('Tico', 'Pássaro', 'Canário', '2020-02-01', 1),
('Faisca', 'Gato', 'Siamês', '2019-05-10', 2);

 

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
    idAnimal int not null,
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

 
create table statusConsulta
(
	idStatus int primary key not null,
    statusConsulta varchar(50)
);
insert into StatusConsulta (idStatus, statusConsulta)
values (1, 'Em espera'),
(2, 'Consultório');
 

create table Agenda
(
	idConsulta int auto_increment primary key,
	dataConsulta date not null,
	horaConsulta time not null, 
	veterinario int,
	descricao text,
	idAnimal int not null,
    idStatus int,
    foreign key (idStatus) references statusConsulta(idStatus),
	foreign key (idAnimal) references Animais(idAnimal)
);
insert into Agenda (dataConsulta, horaConsulta, veterinario, idAnimal, descricao, idStatus)
values ('2023-08-20', '14:00:00', 1, 1, 'Exame de rotina', 1),
('2023-09-14', '10:30:00', 1, 2, 'Vacinação', 2),
('2023-08-18', '10:35:00', 1, 3, 'Avaliação de saúde', 1);



 

/* TESTE SELECT PARA ANIMAIS E AGENDA
select Animais.nome, Agenda.descricao
from Agenda inner join Animais on Animais.idAnimal = Agenda.idAnimal;
*/

 

 
/* SELECT AGENDA PARA DATA ATUAL E ORDERNAR POR HORÁRIO 
select * from Agenda
where date(dataConsulta) = current_date()
order by horaConsulta asc; */
 
/* TESTE SELECT PARA AGENDA E ANIMAIS
 select * from Animais
inner join Agenda on Animais.idAnimal = Agenda.idAnimal
group by Agenda.dataConsulta, Agenda.horaConsulta;
*/

/* TESTE SELECT PARA INFORMAÇÕES ADICIONAIS
select Agenda.idConsulta, Agenda.descricao, Usuarios.nome as veterinario, Animais.nome as nomeanimal, Animais.especie, Animais.raca, Clientes.nome as nomecliente
from Animais
inner join Agenda on Animais.idAnimal = Agenda.idAnimal
inner join Usuarios on Agenda.veterinario = Usuarios.idUsuario
inner join Clientes on Animais.idCliente = Clientes.idCliente
group by Agenda.dataConsulta, Agenda.horaConsulta;
*/

select * from Usuarios;
select * from Clientes;
select * from Animais;
select * from Agenda;
select * from HistoricoMedico;
select * from Acesso;
select * from statusConsulta;


