-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/08/2023 às 05:40
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `monica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `sobrenome` varchar(30) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `telefone` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `consignados`
--

CREATE TABLE `consignados` (
  `id_consignado` int(11) NOT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `descricao` varchar(80) DEFAULT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `quantidade_compra` varchar(30) DEFAULT NULL,
  `quantidade_atual` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `id_produto` int(8) NOT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `quantidade` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fechamentos`
--

CREATE TABLE `fechamentos` (
  `id` int(11) NOT NULL,
  `mes` varchar(10) DEFAULT NULL,
  `valor_custo_t` decimal(9,2) DEFAULT NULL,
  `valor_venda_t` decimal(9,2) DEFAULT NULL,
  `valor_lucro_t` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fechamentos_consig`
--

CREATE TABLE `fechamentos_consig` (
  `id` int(11) NOT NULL,
  `mes` varchar(10) DEFAULT NULL,
  `valor_custo_t` decimal(9,2) DEFAULT NULL,
  `valor_venda_t` decimal(9,2) DEFAULT NULL,
  `valor_lucro_t` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `nome_fornecedor` varchar(80) DEFAULT NULL,
  `nome_empresa` varchar(80) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `logar`
--

CREATE TABLE `logar` (
  `user` varchar(30) DEFAULT NULL,
  `senha` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `valores`
--

CREATE TABLE `valores` (
  `id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id_venda` int(11) NOT NULL,
  `id_produto` int(8) DEFAULT NULL,
  `id_cliente` int(8) DEFAULT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `data_venda` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Acionadores `vendas`
--
DELIMITER $$
CREATE TRIGGER `trg_after_insert_vendas` AFTER INSERT ON `vendas` FOR EACH ROW BEGIN
    update estoque set quantidade = quantidade - 1
    WHERE id_produto = NEW.id_produto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas_aberto`
--

CREATE TABLE `vendas_aberto` (
  `id_venda` int(11) NOT NULL,
  `id_produto` int(8) DEFAULT NULL,
  `id_cliente` int(8) DEFAULT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `valor_pago` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `data_venda` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Acionadores `vendas_aberto`
--
DELIMITER $$
CREATE TRIGGER `trg_after_delete_aberto` AFTER DELETE ON `vendas_aberto` FOR EACH ROW BEGIN
    update estoque set quantidade = quantidade + 1
    WHERE id_produto = OLD.id_produto;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_after_insert_aberto` AFTER INSERT ON `vendas_aberto` FOR EACH ROW BEGIN
    update estoque set quantidade = quantidade - 1
    WHERE id_produto = NEW.id_produto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas_aberto_consig`
--

CREATE TABLE `vendas_aberto_consig` (
  `id_venda` int(11) NOT NULL,
  `id_consignado` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `descricao` varchar(80) DEFAULT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `valor_pago` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `data_venda` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Acionadores `vendas_aberto_consig`
--
DELIMITER $$
CREATE TRIGGER `trg_after_delete_aberto_c` AFTER DELETE ON `vendas_aberto_consig` FOR EACH ROW BEGIN
    update consignados set quantidade_atual = quantidade_atual + 1
    WHERE id_consignado = OLD.id_consignado;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_after_insert_aberto_c` AFTER INSERT ON `vendas_aberto_consig` FOR EACH ROW BEGIN
    update consignados set quantidade_atual = quantidade_atual - 1
    WHERE id_consignado = NEW.id_consignado;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas_consignados`
--

CREATE TABLE `vendas_consignados` (
  `id_venda` int(11) NOT NULL,
  `id_consignado` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `descricao` varchar(80) DEFAULT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `data_venda` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Acionadores `vendas_consignados`
--
DELIMITER $$
CREATE TRIGGER `trg_after_insert_consig` AFTER INSERT ON `vendas_consignados` FOR EACH ROW BEGIN
    update consignados set quantidade_atual = quantidade_atual - 1
    WHERE id_consignado = NEW.id_consignado;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas_mes`
--

CREATE TABLE `vendas_mes` (
  `id_produto` int(8) DEFAULT NULL,
  `id_cliente` int(8) DEFAULT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `data_venda` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas_mes_consig`
--

CREATE TABLE `vendas_mes_consig` (
  `id_consignado` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `descricao` varchar(80) DEFAULT NULL,
  `preco_compra` decimal(9,2) DEFAULT NULL,
  `preco_venda` decimal(9,2) DEFAULT NULL,
  `data_venda` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `consignados`
--
ALTER TABLE `consignados`
  ADD PRIMARY KEY (`id_consignado`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `fechamentos`
--
ALTER TABLE `fechamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fechamentos_consig`
--
ALTER TABLE `fechamentos_consig`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id_venda`);

--
-- Índices de tabela `vendas_aberto`
--
ALTER TABLE `vendas_aberto`
  ADD PRIMARY KEY (`id_venda`);

--
-- Índices de tabela `vendas_aberto_consig`
--
ALTER TABLE `vendas_aberto_consig`
  ADD PRIMARY KEY (`id_venda`);

--
-- Índices de tabela `vendas_consignados`
--
ALTER TABLE `vendas_consignados`
  ADD PRIMARY KEY (`id_venda`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `consignados`
--
ALTER TABLE `consignados`
  MODIFY `id_consignado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id_produto` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fechamentos`
--
ALTER TABLE `fechamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fechamentos_consig`
--
ALTER TABLE `fechamentos_consig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vendas_aberto`
--
ALTER TABLE `vendas_aberto`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vendas_aberto_consig`
--
ALTER TABLE `vendas_aberto_consig`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vendas_consignados`
--
ALTER TABLE `vendas_consignados`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
