PGDMP      *    	            }         
   BetterLife    17.5    17.5 $    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            �           1262    16559 
   BetterLife    DATABASE        CREATE DATABASE "BetterLife" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE "BetterLife";
                     postgres    false            �            1259    16571    clientes    TABLE     �  CREATE TABLE public.clientes (
    id_cliente integer NOT NULL,
    nombre character varying(50) NOT NULL,
    apellidos character varying(50) NOT NULL,
    email character varying(100) NOT NULL,
    contrasenia bytea NOT NULL,
    edad integer NOT NULL,
    peso character(5) NOT NULL,
    estatura character(5) NOT NULL,
    brazor character varying(5) NOT NULL,
    brazoc character varying(5) NOT NULL,
    cintura character(5) NOT NULL,
    pierna character varying(5) NOT NULL,
    intereses character varying(10) NOT NULL,
    genero character varying(10) NOT NULL,
    tipousuario character(7) NOT NULL,
    status boolean DEFAULT true
);
    DROP TABLE public.clientes;
       public         heap r       postgres    false            �            1259    16570    clientes_id_cliente_seq    SEQUENCE     �   CREATE SEQUENCE public.clientes_id_cliente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.clientes_id_cliente_seq;
       public               postgres    false    220            �           0    0    clientes_id_cliente_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.clientes_id_cliente_seq OWNED BY public.clientes.id_cliente;
          public               postgres    false    219            �            1259    16561    profesionales    TABLE     �  CREATE TABLE public.profesionales (
    id_profesional integer NOT NULL,
    nombre character varying(50) NOT NULL,
    apellidos character varying(50) NOT NULL,
    email character varying(100) NOT NULL,
    contrasenia bytea NOT NULL,
    especialidad character varying(30) NOT NULL,
    enfoque character varying(600) NOT NULL,
    eslogan character varying(150),
    tipousuario character(11) NOT NULL,
    status boolean DEFAULT true
);
 !   DROP TABLE public.profesionales;
       public         heap r       postgres    false            �            1259    16560     profesionales_id_profesional_seq    SEQUENCE     �   CREATE SEQUENCE public.profesionales_id_profesional_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.profesionales_id_profesional_seq;
       public               postgres    false    218            �           0    0     profesionales_id_profesional_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.profesionales_id_profesional_seq OWNED BY public.profesionales.id_profesional;
          public               postgres    false    217            �            1259    16618    rutinas    TABLE     J  CREATE TABLE public.rutinas (
    id_rutina integer NOT NULL,
    id_cliente integer,
    id_profesional integer,
    descripcionrutina character varying(1000),
    tiporutina character varying(15),
    lunes character varying(100) NOT NULL,
    detallesl character varying(200) NOT NULL,
    martes character varying(100) NOT NULL,
    detallesm character varying(200) NOT NULL,
    miercoles character varying(100) NOT NULL,
    detallesw character varying(200) NOT NULL,
    jueves character varying(100) NOT NULL,
    detallesj character varying(200) NOT NULL,
    viernes character varying(100) NOT NULL,
    detallesv character varying(200) NOT NULL,
    sabado character varying(100) NOT NULL,
    detalless character varying(200) NOT NULL,
    domingo character varying(100) NOT NULL,
    detallesd character varying(200) NOT NULL
);
    DROP TABLE public.rutinas;
       public         heap r       postgres    false            �            1259    16617    rutinas_id_rutina_seq    SEQUENCE     �   CREATE SEQUENCE public.rutinas_id_rutina_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.rutinas_id_rutina_seq;
       public               postgres    false    224            �           0    0    rutinas_id_rutina_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.rutinas_id_rutina_seq OWNED BY public.rutinas.id_rutina;
          public               postgres    false    223            �            1259    16600    solicitudes    TABLE       CREATE TABLE public.solicitudes (
    id_solicitud integer NOT NULL,
    id_cliente integer NOT NULL,
    id_profesional integer NOT NULL,
    tiporutina character varying(15) NOT NULL,
    fecha_solicitud timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.solicitudes;
       public         heap r       postgres    false            �            1259    16599    solicitudes_id_solicitud_seq    SEQUENCE     �   CREATE SEQUENCE public.solicitudes_id_solicitud_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.solicitudes_id_solicitud_seq;
       public               postgres    false    222            �           0    0    solicitudes_id_solicitud_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.solicitudes_id_solicitud_seq OWNED BY public.solicitudes.id_solicitud;
          public               postgres    false    221            2           2604    16574    clientes id_cliente    DEFAULT     z   ALTER TABLE ONLY public.clientes ALTER COLUMN id_cliente SET DEFAULT nextval('public.clientes_id_cliente_seq'::regclass);
 B   ALTER TABLE public.clientes ALTER COLUMN id_cliente DROP DEFAULT;
       public               postgres    false    219    220    220            0           2604    16564    profesionales id_profesional    DEFAULT     �   ALTER TABLE ONLY public.profesionales ALTER COLUMN id_profesional SET DEFAULT nextval('public.profesionales_id_profesional_seq'::regclass);
 K   ALTER TABLE public.profesionales ALTER COLUMN id_profesional DROP DEFAULT;
       public               postgres    false    218    217    218            6           2604    16621    rutinas id_rutina    DEFAULT     v   ALTER TABLE ONLY public.rutinas ALTER COLUMN id_rutina SET DEFAULT nextval('public.rutinas_id_rutina_seq'::regclass);
 @   ALTER TABLE public.rutinas ALTER COLUMN id_rutina DROP DEFAULT;
       public               postgres    false    223    224    224            4           2604    16603    solicitudes id_solicitud    DEFAULT     �   ALTER TABLE ONLY public.solicitudes ALTER COLUMN id_solicitud SET DEFAULT nextval('public.solicitudes_id_solicitud_seq'::regclass);
 G   ALTER TABLE public.solicitudes ALTER COLUMN id_solicitud DROP DEFAULT;
       public               postgres    false    221    222    222            �          0    16571    clientes 
   TABLE DATA           �   COPY public.clientes (id_cliente, nombre, apellidos, email, contrasenia, edad, peso, estatura, brazor, brazoc, cintura, pierna, intereses, genero, tipousuario, status) FROM stdin;
    public               postgres    false    220   �2       �          0    16561    profesionales 
   TABLE DATA           �   COPY public.profesionales (id_profesional, nombre, apellidos, email, contrasenia, especialidad, enfoque, eslogan, tipousuario, status) FROM stdin;
    public               postgres    false    218   S3       �          0    16618    rutinas 
   TABLE DATA           �   COPY public.rutinas (id_rutina, id_cliente, id_profesional, descripcionrutina, tiporutina, lunes, detallesl, martes, detallesm, miercoles, detallesw, jueves, detallesj, viernes, detallesv, sabado, detalless, domingo, detallesd) FROM stdin;
    public               postgres    false    224   b5       �          0    16600    solicitudes 
   TABLE DATA           l   COPY public.solicitudes (id_solicitud, id_cliente, id_profesional, tiporutina, fecha_solicitud) FROM stdin;
    public               postgres    false    222   �5       �           0    0    clientes_id_cliente_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.clientes_id_cliente_seq', 1, true);
          public               postgres    false    219            �           0    0     profesionales_id_profesional_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public.profesionales_id_profesional_seq', 3, true);
          public               postgres    false    217            �           0    0    rutinas_id_rutina_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.rutinas_id_rutina_seq', 7, true);
          public               postgres    false    223            �           0    0    solicitudes_id_solicitud_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.solicitudes_id_solicitud_seq', 9, true);
          public               postgres    false    221            :           2606    16579    clientes clientes_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id_cliente);
 @   ALTER TABLE ONLY public.clientes DROP CONSTRAINT clientes_pkey;
       public                 postgres    false    220            8           2606    16569     profesionales profesionales_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.profesionales
    ADD CONSTRAINT profesionales_pkey PRIMARY KEY (id_profesional);
 J   ALTER TABLE ONLY public.profesionales DROP CONSTRAINT profesionales_pkey;
       public                 postgres    false    218            >           2606    16625    rutinas rutinas_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.rutinas
    ADD CONSTRAINT rutinas_pkey PRIMARY KEY (id_rutina);
 >   ALTER TABLE ONLY public.rutinas DROP CONSTRAINT rutinas_pkey;
       public                 postgres    false    224            <           2606    16606    solicitudes solicitudes_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitudes_pkey PRIMARY KEY (id_solicitud);
 F   ALTER TABLE ONLY public.solicitudes DROP CONSTRAINT solicitudes_pkey;
       public                 postgres    false    222            A           2606    16626    rutinas rutinas_id_cliente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rutinas
    ADD CONSTRAINT rutinas_id_cliente_fkey FOREIGN KEY (id_cliente) REFERENCES public.clientes(id_cliente) ON DELETE CASCADE;
 I   ALTER TABLE ONLY public.rutinas DROP CONSTRAINT rutinas_id_cliente_fkey;
       public               postgres    false    224    220    4666            B           2606    16631 #   rutinas rutinas_id_profesional_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rutinas
    ADD CONSTRAINT rutinas_id_profesional_fkey FOREIGN KEY (id_profesional) REFERENCES public.profesionales(id_profesional) ON DELETE CASCADE;
 M   ALTER TABLE ONLY public.rutinas DROP CONSTRAINT rutinas_id_profesional_fkey;
       public               postgres    false    4664    218    224            ?           2606    16607 '   solicitudes solicitudes_id_cliente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitudes_id_cliente_fkey FOREIGN KEY (id_cliente) REFERENCES public.clientes(id_cliente) ON DELETE CASCADE;
 Q   ALTER TABLE ONLY public.solicitudes DROP CONSTRAINT solicitudes_id_cliente_fkey;
       public               postgres    false    220    4666    222            @           2606    16612 +   solicitudes solicitudes_id_profesional_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitudes_id_profesional_fkey FOREIGN KEY (id_profesional) REFERENCES public.profesionales(id_profesional) ON DELETE CASCADE;
 U   ALTER TABLE ONLY public.solicitudes DROP CONSTRAINT solicitudes_id_profesional_fkey;
       public               postgres    false    222    4664    218            �   �   x��M� @��p���៺sgb<B7�0m�����k�|yO�����\Z�ކ�)#\��ׂy���7㴤)���{P�H�H&�Q)���\��4�hL�l-h���T�T����*�=S�P�A�-��e����yB|��2�      �   �  x�eR=o!��_A�H��,��b�RD��(Jm3�p�ba�)��I��]��c�]�-9A3Û�5�Y\��l�`�̿(H	���O�	���qb��k�j��+�dm�JX�wv�Pu�*쌨Tm�@� km=���$}<D�����A>c�����J�<�_(�yיr��!�`1Mh�`�P�g�4d6ޱ9E��� ��]î=�C0)�|�	���f~�3굪�nZQ��W�jUeM�u�V�Z)�m�Kݙ���^��}&$����89%���Y�#%y���O�Q�cqG"�a>=%��
p� h�:-Y/�/18K�;=��c���ڃyF���pgN��g��:�VlR�kµd{奘h�Xp��ܺ0�=[���ǰ_��/=4c9=�@�P՜𸶞3~S}u�6�3�y����/�K�&�"7K"/ɢ��k�ۗ�� 2ؤ)xo\+u/[�R�V��I����P7��J�i�l��E�d.c+&���-�/w��_�.      �   u   x�}��
�@Dϓ�)H��/Qw1�	�e����J�*�K2�T�Vy���CM�
�S�=7�Z{�/��C�̞�F�t҉!�#"��y9��׬R����+�spȍ�kQ� �/"rQ�      �   J   x���4�ԒDN##S]S]#K##+c+=3c.K�"#�ԬԢ����|,J-�J,�b���� 4�1     