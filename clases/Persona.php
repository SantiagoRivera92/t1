<?php

class Persona
{

    private const AÑO_ACTUAL = 2026;

    private string $nombre;
    private string $apellido;
    private int $año;

    public function __construct(string $nombre, string $apellido, int $añoNacimiento)
    {
        $this->nombre = ucfirst($nombre);
        $this->apellido = ucfirst($apellido);
        $this->año = $añoNacimiento;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = ucfirst($nombre);
    }

    public function setApellido(string $apellido): void
    {
        $this->apellido = ucfirst($apellido);
    }

    public function setAño(int $año): void
    {
        $this->año = $año;
        if ($año > self::AÑO_ACTUAL - 18) {
            echo "<b>AVISO:</b> El año de nacimiento debe ser menor a " . (self::AÑO_ACTUAL - 17) . " para ser mayor de edad.";
        }
    }

    public function getNombre(): string
    {
        return ucfirst($this->nombre);
    }

    public function getApellido(): string
    {
        return ucfirst($this->apellido);
    }

    public function getAño(): int
    {
        return $this->año;
    }

    public function imprimirNombreCompleto()
    {
        echo "Me llamo " . $this->nombre . " " . $this->apellido;
    }
}


?>