drop table if exists usuarios cascade;

create table usuarios (
    id_usuarios   bigserial    constraint pk_usuarios primary key,
    nombre        varchar(15)  not null constraint uq_usuarios_nombre unique,
    password      varchar(60)  not null,
    email         varchar(255) not null,
    token         varchar(32),
    activacion    varchar(32),
    created_at    timestamptz  default current_timestamp
);

create index idx_usuarios_activacion on usuarios (activacion);
create index idx_usuarios_created_at on usuarios (created_at);

drop table if exists noticias cascade;

    create table noticias (
        id_noticias   bigserial     constraint pk_noticias primary key,
        titulo        varchar(55)   not null constraint uq_noticias_titulo unique,
        cuerpo        varchar(500)  not null,
        meneos        numeric(6)    not null,
        created_at    timestamptz  default current_timestamp
    );


drop table if exists comentarios cascade;

    create table comentarios (
        id_comentarios bigserial     constraint pk_comentarios primary key,
        cuerpo         varchar(200)  not null,
        id_noticias    numeric(6)    not null,
        created_at     timestamptz   default current_timestamp
        );

drop table if exists come_noti cascade;

    create table come_noti (
        id_come_noti   bigserial     constraint pk_come_noti primary key,
        id_comentarios bigint        not null constraint fk_alquileres_comentarios
                                     references comentarios (id_comentarios)
                                     on delete no action on update cascade,
        id_noticias    bigint        not null constraint fk_alquileres_noticias
                                     references noticias (id_noticias)
                                     on delete no action on update cascade,
        created_at     timestamptz  default current_timestamp
    );
