describe('Crear Reseñas', () => {
  it('Permite a los usuarios crear reseñas', () => {
    cy.visit('http://localhost:3000/CRUD/REVIEWS/Crear-Review/3')


    cy.get('input[type="text"]').type('Título de la reseña')
    cy.get('textarea').type('Este es un comentario de la reseña.')
   
    cy.fixture('micu.jpeg').then(fileContent => {
      cy.get('input[type="file"]').attachFile({
        fileContent: fileContent.toString(),
        fileName: 'micu.jpeg',
        mimeType: 'image/jpeg'
      });
    });


    cy.get('input[type="radio"]').check('5', { force: true });


    cy.get('form').submit()


    cy.url().should('include', '/')
    cy.log('Reseña enviada correctamente');
  })
})



