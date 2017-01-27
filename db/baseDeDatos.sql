drop table if exists noticias cascade;

create table noticias (
    id_noticia    bigserial     constraint pk_noticias primary key,
    id_usuario    bigint        constraint fk_noticias_usuarios
                                references public.user (id)
                                on delete no action on update cascade,
    titulo        varchar(55)   not null,
    cuerpo        varchar(500)  not null,
    meneos        numeric(6)    default 0,
    url           varchar(200)  not null,
    created_at    timestamptz   default current_timestamp
);

create index idx_noticias_titulo on noticias (titulo);
create index idx_noticias_create_at on noticias (create_at);

drop table if exists comentarios cascade;

create table comentarios (
    id_comentario  bigserial     constraint pk_comentarios primary key,
    id_usuario     bigint        constraint fk_noticias_usuarios
                                 references public.user (id)
                                 on delete no action on update cascade,
    votos          numeric(6)    default 0,
    cuerpo         varchar(500)  not null,
    created_at     timestamptz   default current_timestamp
);

create index idx_comentarios_votos on comentarios (votos);
create index idx_comentarios_create_at on comentarios (create_at);

drop table if exists come_noti cascade;

create table comentarios_noticias (
    id_comentario_noticia   bigserial constraint pk_comentarios_noticias primary key,
    id_comentario           bigint    constraint fk_comentarios_comentarios
                                      references comentarios (id_comentario)
                                      on delete no action on update cascade,
    id_noticia              bigint    constraint fk_noticias_noticias
                                      references noticias (id_noticia)
                                      on delete no action on update cascade
);
