# Technical test for back-end developer

## Objectives: 
- Create a contact page with dynamic fields 
```
1. The form must register the contact requests un a table called « contacts » 
2. When choosing the subject, the fields in the form are updated (no need to refresh the page) 
```
> Find hereunder the fields in a contact form (they change according to the selected subject) 

- Common fields: 
    - Subject [ Choice between (« Contact request », « Notify of a problem », « Registration request ») ] *required

- Fields when « Contact request » is selected: 
    - Email [ email ] *required
    - Surname [ Short free text ] *required
    - Message [ Long free text ] *required
- Fields when « Notify of a problem » is selected: 
    - Object (or reason) [ Chose between (« An error has occurred », « I need help » , « Other ») ] *required
    - Details [ Free text ] *required
- Fields when « Registration request » is selected: 
    - Email [ email ] *required
    - Surname (or name) [ Texte court libre ] *required
    - Phone number *optional
    - Adress *required
    - Message [ long free text ] *optional
