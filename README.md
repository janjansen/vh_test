vh_test
=======
Как запустить:
1. Конфиг DB
app.config.parameters.yml<br /> (должен быть залит дамп из задачи)
2. Миграции php bin/console doctrine:migrations:migrate
3. Запуск сервера php bin/console server:run
4. Зайти на URL http://127.0.0.1:8000/orm и http://127.0.0.1:8000/no-orm


**Вопрос 1**<br />
SELECT DISTINCT MEDREC_ID, PATIENT_NAME
FROM tb_source tbs
WHERE 
  PATIENT_NAME LIKE 'Alex%'
  AND EXISTS (SELECT 1 FROM tb_rel tbr WHERE tbr.MEDREC_ID = tbs.MEDREC_ID);
  
**Вопрос 2**<br />
SELECT count(*) FROM (SELECT count(*) AS cnt FROM tb_rel GROUP BY MEDREC_ID, NDC HAVING cnt > 1) sq;

**Вопрос 3**<br />
У нас есть 3 различных сущности: Пациент, Болезнь и Лекарство
поэтому они были вынесены в отдельные таблицы. Таблицы tb_patient_disease и tb_patient_drug
реализуют отношение Многие Ко Многим. Так как в таблицы нет интенсивной 
записи мы можем широко использовать индексы.

1. UNIQUE INDEX patient.medres_id гарантирует уникальность medres_id
2. INDEX patient.name для поиска по имени (name LIKE 'Alex%')
3. UNIQUE INDEX patient_disease_unique (patient_id, disease_id) - гарантирует ограничение из условия задачи
(Один и тот же диагноз может быть выставлен пациенту только один раз.)
