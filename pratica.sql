WITH elenco_nomicampi AS (
SELECT DISTINCT json_object_keys(data) as campo FROM suape.pratica order by 1
),
elenco_campi AS (
SELECT DISTINCT format('data->>\'%s\'',json_object_keys(data)) as campo FROM suape.pratica order by 1
)
SELECT format('SELECT %s FROM suape.pratica',string_agg(campo,',')) from elenco_campi



SELECT 
	data->>'codice-fiscale',
	data->>'denominazione',
	data->>'domicilio-elettr-email',
	data->>'macro-proc-classe-id',
	data->>'partita-iva',
	data->>'pratica-codice',
	data->>'pratica-comunica',
	data->>'pratica-data-modifica',
	data->>'pratica-data-presenta',
	data->>'pratica-data-presentazione-da-web',
	data->>'pratica-data-protocollo',
	data->>'pratica-data-scadenza',
	data->>'pratica-id',
	data->>'pratica-macro-proc-des',
	data->>'pratica-macro-proc-id',
	data->>'pratica-numero',
	data->>'pratica-numero-protocollo',
	data->>'pratica-oggetto',
	data->>'pratica-responsabile-cognome',
	data->>'pratica-responsabile-id',
	data->>'pratica-responsabile-nome',
	data->>'pratica-status-des',
	data->>'pratica-status-id',
	data->>'pratica-struttura-des',
	data->>'pratica-struttura-id',
	data->>'pratica-struttura-orig-id',
	data->>'pratica-tipo-avvio-des',
	data->>'pratica-tipo-avvio-id',
	data->>'pratica-tipo-intervento-des',
	data->>'pratica-tipo-intervento-id',
	data->>'pratica-web',
	data->>'responsabile-cod-fiscale',
	data->>'richiedente-id',
	data->>'tipo-richiedente-des',
	data->>'tipo-richiedente-id',
	data->>'ubic-cap',
	data->>'ubic-comune-des',
	data->>'ubic-comune-id',data->>'ubic-indirizzo',data->>'ubic-lat',data->>'ubic-lng',data->>'ubic-provincia-des',data->>'ubic-provincia-id',data->>'versione-macro-endo-id',data->>'versione-struttura-tree-id' FROM suape.pratica

