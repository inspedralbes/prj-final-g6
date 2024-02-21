describe('GitHub Home Page', () => {
  it('Carga de la página', () => {
    cy.visit('https://github.com')
    cy.contains('GitHub').should('exist')
  })
  

  it('Verifica la existencia del botón "Sign up"', () => {
    cy.visit('https://github.com')
    cy.contains('Sign up').should('exist')
  })

  it('Comprueba la visibilidad del botón "Sign in"', () => {
    cy.visit('https://github.com')
    cy.contains('Sign in').should('be.visible')
  })

  it('Hace clic en el botón "Sign in" y verifica que se redirige a la página de inicio de sesión', () => {
    cy.visit('https://github.com')
    cy.contains('Sign in').click()
    cy.url().should('include', '/login')
  })
})
