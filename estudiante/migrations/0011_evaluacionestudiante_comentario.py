# Generated by Django 2.2.4 on 2020-08-11 01:16

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('estudiante', '0010_auto_20200810_1948'),
    ]

    operations = [
        migrations.AddField(
            model_name='evaluacionestudiante',
            name='comentario',
            field=models.TextField(blank=True, null=True),
        ),
    ]
