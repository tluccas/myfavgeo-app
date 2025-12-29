"use client";

import React, { useState } from "react";
import Link from "next/link";
import { useRouter } from "next/navigation";
import api from "@/lib/api";
import { Button } from "@/components/ui/Button";
import { Input } from "@/components/ui/Input";

export default function RegisterPage() {
  const router = useRouter();
  const [formData, setFormData] = useState({
    nome: "",
    email: "",
    password: "",
    confirm_password: "",
  });
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState("");
  const [fieldErrors, setFieldErrors] = useState<Record<string, string>>({});

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
    // Limpa os erros quando o usuário digita
    setError("");
    if (fieldErrors[name]) {
      setFieldErrors((prev) => {
        const newErrors = { ...prev };
        delete newErrors[name];
        return newErrors;
      });
    }
  };

  const validate = () => {
    const errors: Record<string, string> = {};

    if (formData.password.length < 6) {
      errors.password = "A senha deve ter no mínimo 6 caracteres";
    }

    if (formData.password !== formData.confirm_password) {
      errors.confirm_password = "As senhas não coincidem";
    }

    setFieldErrors(errors);
    return Object.keys(errors).length === 0;
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    if (!validate()) return;

    setIsLoading(true);
    setError("");

    try {
      await api.post("/register", formData);

      window.location.href = "/mapas";
      // eslint-disable-next-line @typescript-eslint/no-explicit-any
    } catch (err: any) {
      console.error("Registration error:", err);

      if (err.response?.data?.errors) {
        // Lida com erros de validação do backend
        const backendErrors = err.response.data.errors;
        const newFieldErrors: Record<string, string> = {};

        Object.keys(backendErrors).forEach((key) => {
          newFieldErrors[key] = backendErrors[key][0];
        });

        setFieldErrors(newFieldErrors);
      } else {
        setError(
          err.response?.data?.message ||
            "Falha ao realizar cadastro. Tente novamente."
        );
      }
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="flex flex-col items-center justify-center bg-secondary/30 px-4 py-12 sm:px-6 lg:px-8">
      <div className="w-full max-w-md space-y-8 rounded-xl bg-background p-8 shadow-lg ring-1 ring-border">
        <div className="text-center">
          <h2 className="mt-2 text-3xl font-bold tracking-tight text-foreground">
            Crie sua conta
          </h2>
          <p className="mt-2 text-sm text-muted">
            Comece a salvar seus lugares favoritos hoje mesmo
          </p>
        </div>

        <form className="mt-8 space-y-6" onSubmit={handleSubmit}>
          <div className="space-y-4">
            <Input
              id="nome"
              name="nome"
              type="text"
              autoComplete="name"
              required
              label="Nome Completo"
              placeholder="Seu Nome"
              value={formData.nome}
              onChange={handleChange}
              error={fieldErrors.nome}
            />

            <Input
              id="email"
              name="email"
              type="email"
              autoComplete="email"
              required
              label="Email"
              placeholder="seu@email.com"
              value={formData.email}
              onChange={handleChange}
              error={fieldErrors.email}
            />

            <Input
              id="password"
              name="password"
              type="password"
              autoComplete="new-password"
              required
              label="Senha"
              placeholder="••••••••"
              value={formData.password}
              onChange={handleChange}
              error={fieldErrors.password}
            />

            <Input
              id="confirm_password"
              name="confirm_password"
              type="password"
              autoComplete="new-password"
              required
              label="Confirmar Senha"
              placeholder="••••••••"
              value={formData.confirm_password}
              onChange={handleChange}
              error={fieldErrors.confirm_password}
            />
          </div>

          {error && (
            <div className="rounded-md bg-red-50 p-4 text-sm text-red-500">
              {error}
            </div>
          )}

          <div>
            <Button type="submit" className="w-full" isLoading={isLoading}>
              Cadastrar
            </Button>
          </div>

          <div className="text-center text-sm">
            <span className="text-muted">Já tem uma conta? </span>
            <Link
              href="/login"
              className="font-medium text-primary hover:text-primary/80 hover:underline"
            >
              Faça login
            </Link>
          </div>
        </form>
      </div>
    </div>
  );
}
