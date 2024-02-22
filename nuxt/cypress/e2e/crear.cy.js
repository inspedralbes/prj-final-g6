describe('Pruebas múltiples del componente', () => {
  beforeEach(() => {
      // Antes de cada test, visita la página del componente
      cy.visit('http://localhost:3000/CRUD/USUARIOS/crud_usuarios'); // Asegúrate de reemplazar con la ruta correcta
  });

  it('Debería renderizar correctamente y cargar datos', () => {
      cy.get('.container').should('exist');
      cy.get('.user-table').should('exist');
      cy.get('.user-table-item').should('have.length.greaterThan', 0);
  });

  it('Debería eliminar un usuario y actualizar la lista', () => {
      // Asegúrate de tener al menos un usuario en tu API antes de ejecutar esta prueba
      cy.get('.user-table-item').first().as('primerUsuario');
      cy.get('@primerUsuario').invoke('text').then((textBeforeDelete) => {
          cy.get('@primerUsuario').find('.btn-delete').click();
          // Asegúrate de manejar el cuadro de confirmación o cualquier lógica relacionada con la eliminación
          cy.get('.user-table-item').should('not.contain', textBeforeDelete);
      });
  });

  it('Debería navegar a la página de creación de usuario al hacer clic en el botón "Crear"', () => {
      cy.get('.btn-create').click();
      // Asegúrate de verificar que la navegación se haya realizado correctamente
      cy.url().should('include', '/CRUD/USUARIOS/crear');
  });

  it('Debería navegar a la página de edición al hacer clic en el botón "Editar"', () => {
      cy.get('.user-table-item').first().find('.btn-edit').click();
      // Asegúrate de verificar que la navegación se haya realizado correctamente
      cy.url().should('include', '/CRUD/USUARIOS/');
  });
});
