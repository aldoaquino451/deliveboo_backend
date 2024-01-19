Deliveboo 
===

- App\Http\Controllers\Auth\AuthenticatedSessionController.php 
- destroy()
- return redirect('http://localhost:5174/');

### To Do List

- Form User: l'immagine e descrizione deve essre obbligatoria?
- Va aggiunta la validazione delle tipologie dei ristoranti
- Form prodotti update: checkbox metodo old() non funziona bene

**Front End**
- Carrello: 
  - posso scegliere un solo ristorante 
  - se aggiungo i prodotti da un nuovo ristorante deve darmi errore (controllo restaurant id)
  - crea una pagina per i carrello con all'interno il form dati del cliente
  - se confermato parte la chiamata con brain tree ceh restituisce la conferma del pagamento 

- Tipologie:
  - deve partire la chiamata api al click 
  - stampare il numero di risultati
  - visualizza tutte le tipologie del ristorante (opzionale)
