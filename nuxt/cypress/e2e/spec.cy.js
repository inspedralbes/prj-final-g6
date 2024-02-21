describe('Cypress Example Page', () => {
  it('Portada', () => {
    cy.visit('https://example.cypress.io')
    cy.get('div:contains("Kitchen Sink")').should('exist').should('be.visible');
  })

  it('verifies the existence of "type" example', () => {
    cy.visit('https://example.cypress.io')
    cy.contains('type').should('exist')
  })

  it('checks the visibility of the "within" example', () => {
    cy.visit('https://example.cypress.io')
    cy.contains('within').should('be.visible')
  })

  it('performs a click on the "focus" example and asserts its functionality', () => {
    cy.visit('https://example.cypress.io')
    cy.contains('focus').click()
    cy.url().should('include', '/commands/actions')
  })

  it('clicks on "Commands" and then on "Actions", and checks the result of "query-btn"', () => {
    cy.visit('https://example.cypress.io')
    cy.contains('Commands').click()
    cy.contains('Querying').click()
    cy.get('#query-btn').click()
    cy.url().should('include', '/commands/querying')
  })
})
