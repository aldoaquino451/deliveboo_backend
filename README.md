Deliveboo 
===

- App\Http\Controllers\Auth\AuthenticatedSessionController.php 
- destroy()
- return redirect('http://localhost:5174/');

### Cose da fare
- Form User da fare il Required 
  - Asterisco campi obbligatori
  - modifica il messaggio che appare se l'email è già presente: questo utente è già registrato!
- Form Products da fare tutta la validazione
  - Asterisco campi obbligatori
  - compreso lato HMTL non permettere di inserire un numero negativo
  - messaggio di riuscita se il prodotto è inserito correttamente
- Delete Modale
- Page Controller per le Api del font end, selezionare più tipologie e restituire i ristoranti (restaurant-by-typologies)
- Il prodotto che non fa parte del proprio ristorante non deve poter essere visualizzato in altri ristoranti (where auth id)
