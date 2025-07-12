// Use DBML to define your database structure
// Docs: https://dbml.dbdiagram.io/docs



Table users {
  id bigint [pk, increment, not null]
  name varchar(100) [not null]
  email varchar(100) [not null, unique]
  email_verified_at timestamp [null]
  password varchar(200) [not null]
  two_factor_secret text [null]
  two_factor_recovery_codes text [null]
  two_factor_confirmed_at timestamp [null]
  remember_token varchar(100) [null]
  created_at timestamp [null]
  updated_at timestamp [null]
  deleted_at timestamp [null]
}

Table collection_points {
  id bigint [pk, increment, not null]
  name varchar(60) [not null]
  cep varchar(8) [not null]
  score int [not null, default: 0]
  user_id bigint [not null, ref: > users.id]
  street varchar(255) [not null]
  number varchar(255) [null]
  complement varchar(255) [null]
  neighborhood varchar(255) [not null]
  city varchar(255) [not null]
  state varchar(2) [not null]
  latitude decimal(10,7) [null]
  longitude decimal(10,7) [null]
  created_at timestamp [null]
  updated_at timestamp [null]
  deleted_at timestamp [null]
  open_from time [not null]
  open_to time [not null]
  days_open varchar(255) [not null]
  description text [null]
}

Table categories {
  id int [pk, not null]
  name varchar(100) [not null]
}

Table collection_point_category {
  id bigint [pk, increment, not null]
  collection_point_id bigint [not null, ref: > collection_points.id]
  category_id bigint [not null, ref: > categories.id]
}