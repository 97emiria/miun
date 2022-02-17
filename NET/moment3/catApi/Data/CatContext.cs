namespace CatApi.Data;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.EntityFrameworkCore;
using CatApi.Models;

    public class CatContext : DbContext
    {
        public CatContext (DbContextOptions<CatContext> options)
            : base(options)
        {
        }

        public DbSet<CatApi.Models.Cat> Cat { get; set; }
    }
