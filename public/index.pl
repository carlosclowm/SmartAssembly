persona(maria).
persona(pepe).

edad(pepe, 22).
edad(maria, 23).

escribeEdades([]) :- write('No hay mas información sobre edades.'), nl.
escribeEdades([Primera|Personas]) :-
 edad(Primera, X), write(Primera), write(' tiene de edad '), write(X), nl, escribeEdades(Personas).

main :-
 write('¡Hola Mundo!'), nl,
 findall(X, persona(X), Personas),
 escribeEdades(Personas).
