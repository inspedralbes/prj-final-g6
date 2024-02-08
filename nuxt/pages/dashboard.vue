<template>
    <div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
          <nuxt-link class="navbar-brand" to="/">My Dashboard</nuxt-link>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <nuxt-link class="nav-link" to="/">Home</nuxt-link>
              </li>
              <li class="nav-item">
                <nuxt-link class="nav-link" to="/dashboard">Dashboard</nuxt-link>
              </li>
            </ul>
          </div>
        </div>
      </nav>
  
      <div class="container mt-4">
        <h1 class="mb-4">Dashboard</h1>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                Usuarios Registrados
              </div>
              <div class="card-body">
                <p class="card-text">Número de usuarios registrados: {{ userCount }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                Gráfico de Usuarios
              </div>
              <div class="card-body">
                <canvas ref="userChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import Chart from 'chart.js';
  
  export default {
    data() {
      return {
        userCount: 100,
        userChartData: {
          labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
          datasets: [{
            label: 'Usuarios Nuevos',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: [20, 30, 40, 10, 0],
          }],
        },
      };
    },
    mounted() {
      this.renderUserChart();
    },
    methods: {
      renderUserChart() {
        const ctx = this.$refs.userChart.getContext('2d');
        new Chart(ctx, {
          type: 'bar',
          data: this.userChartData,
        });
      },
    },
  };
  </script>
  
  <style>
  /* Estilos personalizados */
  body {
    background-color: #f8f9fa;
  }
  
  .card {
    margin-bottom: 20px;
  }
  
  .card-header {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
  }
  
  .navbar {
    margin-bottom: 20px;
  }
  </style>
  