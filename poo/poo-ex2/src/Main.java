public class Main {
    public static void main(String[] args) {
        Aluno aluno1 = new Aluno("Gabriel Saraiva", "INF001", 15);
        Aluno aluno2 = new Aluno("Lucas Dornelles", "INF002", 33);
        Aluno aluno3 = new Aluno("João Felipe", "INF003", 12);
        Aluno aluno4 = new Aluno("Max Verstappen", "INF033", 33);

        Curso cursoDeInformatica = new Curso("Informática");

        cursoDeInformatica.addMateria("Programação Orientada a Objetos");
        cursoDeInformatica.addMateria("Programação WEB 2");
        cursoDeInformatica.addMateria("Banco de Dados");

        Turma inf2am = new Turma("INF2AM", 4, cursoDeInformatica);

        inf2am.addAluno(aluno1);
        inf2am.addAluno(aluno2);
        inf2am.addAluno(aluno3);
        inf2am.addAluno(aluno4);

        SalaDeAula salaDeAula = new SalaDeAula("LabCAD", inf2am, inf2am.getAlunos());

        for (String materia : cursoDeInformatica.getMaterias()) {
            System.out.println(materia);
        }
        System.out.println("= = = = =");

        System.out.println(inf2am.getIdentificador());
        System.out.println(inf2am.getCapacidadeMaxima());
        for (Aluno aluno : inf2am.getAlunos()) {
            System.out.println(aluno.getNome());
        }
        System.out.println("= = = = =");

        // Max Verstappen saiu de sala
        salaDeAula.removerAluno(aluno4);

        for (Aluno aluno : salaDeAula.getAlunosEmSala()) {
            System.out.println(aluno.getNome());
        }
        System.out.println("= = = = =");

    }
}